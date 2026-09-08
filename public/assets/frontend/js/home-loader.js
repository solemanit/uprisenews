// Home Page Loader
// NOTE: API endpoints, response shapes, DOM data-field contracts, and CSS
// classes are unchanged. This is a structural/perf refactor only.
'use strict';

(function () {
    // ---------------------------------------------------------------------
    // Config / constants
    // ---------------------------------------------------------------------
    const FALLBACK_IMAGE = '/assets/frontend/images/placeholder-hero.jpg';
    const LATEST_NEWS_LIMIT = 6;
    const POLITICS_NEWS_LIMIT = 6;

    const ARTICLE_URL = (slug) => `/news-deatils/${slug}`;
    const CATEGORY_URL = (slug) => `/category/${slug}`;

    // Formatters are expensive to construct — build once, reuse everywhere.
    const FORMAT_DATE_LONG = new Intl.DateTimeFormat('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    const FORMAT_DATE_SHORT = new Intl.DateTimeFormat('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    const FORMAT_TIME = new Intl.DateTimeFormat('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });

    const TIME_AGO_UNITS = [
        ['year', 31536000],
        ['month', 2592000],
        ['day', 86400],
        ['hour', 3600],
        ['min', 60],
    ];

    // Declarative map of simple "section -> endpoint -> template -> renderer"
    // sections. Keeps DOMContentLoaded free of repetitive fetch/wire-up code.
    // Sections with bespoke markup (hero, national, economy) are wired up
    // separately below since they don't fit the card-list shape.
    const CARD_SECTIONS = [
        { section: 'latest-news', endpoint: '/home/latest', templateId: 'latest-news-card-template', limit: LATEST_NEWS_LIMIT },
        { section: 'politics-news', endpoint: '/home/politics', templateId: 'politics-news-card-template', limit: POLITICS_NEWS_LIMIT },
    ];

    const MAIN_LIST_SECTIONS = [
        { section: 'national', endpoint: '/home/national' },
        { section: 'economy', endpoint: '/home/economy' },
    ];

    // ---------------------------------------------------------------------
    // Bootstrap
    // ---------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', init);

    function init() {
        wireHero();
        CARD_SECTIONS.forEach(wireCardSection);
        wireTrending();
        MAIN_LIST_SECTIONS.forEach(wireMainListSection);
    }

    function wireHero() {
        const hero = document.querySelector('[data-home-section="hero"]');
        if (!hero) return;

        fetchSection('/home/hero')
            .then((article) => article && renderHero(hero, article));
    }

    function wireCardSection({ section, endpoint, templateId, limit }) {
        const container = document.querySelector(`[data-home-section="${section}"]`);
        const template = document.getElementById(templateId);
        if (!container || !template) return;

        fetchSection(endpoint)
            .then((articles) => renderCards(container, template, articles ?? [], limit));
    }

    function wireTrending() {
        const container = document.querySelector('[data-home-section="trending-now"]');
        const template = document.getElementById('trending-now-card-template');
        if (!container || !template) return;

        fetchSection('/home/trending')
            .then((articles) => renderTrending(container, template, articles ?? []));
    }

    function wireMainListSection({ section, endpoint }) {
        const block = document.querySelector(`[data-home-section="${section}"]`);
        if (!block) return;

        fetchSection(endpoint)
            .then((articles) => renderMainListBlock(block, articles ?? []));
    }

    /**
     * Thin wrapper around apiClient.get that unwraps `{ data }` and
     * swallows failures the same way the original code did (fail silent,
     * leave the static/server-rendered markup in place).
     * @param {string} endpoint
     * @returns {Promise<any>}
     */
    function fetchSection(endpoint) {
        return apiClient.get(endpoint)
            .then(({ data }) => data.data)
            .catch(() => undefined);
    }

    // ---------------------------------------------------------------------
    // DOM helpers
    // ---------------------------------------------------------------------

    /**
     * Small declarative element factory to cut down on repetitive
     * createElement/className/textContent boilerplate below.
     * @param {string} tag
     * @param {{className?: string, text?: string, href?: string, html?: boolean}} [opts]
     */
    function el(tag, opts = {}) {
        const node = document.createElement(tag);
        if (opts.className) node.className = opts.className;
        if (opts.text !== undefined) node.textContent = opts.text;
        if (opts.href !== undefined) node.href = opts.href;
        return node;
    }

    function setImage(img, article) {
        if (!img) return;
        img.src = article.featured_image || FALLBACK_IMAGE;
        img.alt = article.title ?? '';
        img.loading = 'lazy';
        img.decoding = 'async';
    }

    function formatDateSafe(isoDate, formatter) {
        if (!isoDate) return '';
        const d = new Date(isoDate);
        return Number.isNaN(d.getTime()) ? '' : formatter.format(d);
    }

    // ---------------------------------------------------------------------
    // Renderers
    // ---------------------------------------------------------------------

    function renderHero(container, article) {
        setImage(container.querySelector('[data-field="image"]'), article);

        const titleField = container.querySelector('[data-field="title"]');
        if (titleField) titleField.textContent = article.title;

        const excerptField = container.querySelector('[data-field="excerpt"]');
        if (excerptField) excerptField.textContent = article.excerpt ?? '';

        container.querySelector('[data-field="link"]')?.setAttribute('href', ARTICLE_URL(article.slug));

        if (article.category) {
            const catField = container.querySelector('[data-field="category"]');
            if (catField) {
                catField.textContent = article.category.name;
                catField.href = CATEGORY_URL(article.category.slug);
            }
        }

        const authorField = container.querySelector('[data-field="author-name"]');
        if (authorField && article.author) authorField.textContent = article.author.name;

        const dateField = container.querySelector('[data-field="date"]');
        if (dateField) dateField.textContent = formatDateSafe(article.published_at, FORMAT_DATE_LONG);
    }

    // Shared renderer for Latest News + Politics News (identical card shape).
    function renderCards(container, template, articles, limit) {
        if (!articles.length) {
            container.innerHTML = '';
            return;
        }

        const fragment = document.createDocumentFragment();

        articles.slice(0, limit).forEach((article) => {
            const node = template.content.cloneNode(true);
            const detailsUrl = ARTICLE_URL(article.slug);

            setImage(node.querySelector('[data-field="image"]'), article);

            const link = node.querySelector('[data-field="link"]');
            if (link) link.href = detailsUrl;

            const title = node.querySelector('[data-field="title"]');
            if (title) {
                title.textContent = article.title;
                if (title.tagName === 'A') title.href = detailsUrl;
            }

            const category = node.querySelector('[data-field="category"]');
            if (category) {
                if (article.category) {
                    category.textContent = article.category.name;
                    category.href = CATEGORY_URL(article.category.slug);
                } else {
                    category.closest('.post-category')?.remove();
                }
            }

            const dateEl = node.querySelector('[data-field="date"]');
            if (dateEl) dateEl.textContent = article.published_at ? timeAgo(article.published_at) : '';

            fragment.appendChild(node);
        });

        container.innerHTML = '';
        container.appendChild(fragment);
    }

    function renderTrending(container, template, articles) {
        if (!articles.length) {
            container.innerHTML = '';
            return;
        }

        const fragment = document.createDocumentFragment();

        articles.forEach((article) => {
            const node = template.content.cloneNode(true);

            const link = node.querySelector('[data-field="link"]');
            if (link) link.href = ARTICLE_URL(article.slug);

            const title = node.querySelector('[data-field="title"]');
            if (title) title.textContent = article.title;

            const time = node.querySelector('[data-field="time"]');
            if (time) time.textContent = formatDateSafe(article.published_at, FORMAT_TIME);

            fragment.appendChild(node);
        });

        container.innerHTML = '';
        container.appendChild(fragment);
    }

    // National / Economy blocks: first article = big "main" post, remaining
    // articles = compact side list. Markup matches the theme's demo template
    // exactly (see resources .../news-national-economy.blade.php).
    function renderMainListBlock(block, articles) {
        const mainContainer = block.querySelector('[data-field="main"]');
        const listContainer = block.querySelector('[data-field="list"]');

        if (!articles.length) {
            if (mainContainer) mainContainer.innerHTML = '';
            if (listContainer) listContainer.innerHTML = '';
            return;
        }

        const [main, ...rest] = articles;

        if (mainContainer) {
            mainContainer.innerHTML = '';
            mainContainer.appendChild(renderMainPost(main));
        }

        if (listContainer) {
            const fragment = document.createDocumentFragment();
            rest.forEach((article) => fragment.appendChild(renderSidePost(article)));
            listContainer.innerHTML = '';
            listContainer.appendChild(fragment);
        }
    }

    /** Builds the category-then-date meta row shared by the main post. */
    function buildMetaRow(article, { includeSeparator }) {
        const meta = el('div', {
            className: 'post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1',
        });

        if (article.category) {
            const catWrap = el('div');
            const catInner = el('div', { className: 'post-category hstack gap-narrow fw-semibold' });
            const catLink = el('a', {
                className: 'text-none hover:text-primary dark:text-primary duration-150',
                href: CATEGORY_URL(article.category.slug),
                text: article.category.name,
            });
            catInner.appendChild(catLink);
            catWrap.appendChild(catInner);
            meta.appendChild(catWrap);

            if (includeSeparator) {
                meta.appendChild(el('div', { className: 'sep d-none md:d-block', text: '❘' }));
            }
        }

        const dateWrap = el('div', { className: 'd-none md:d-block' });
        const dateInner = el('div', { className: 'post-date hstack gap-narrow' });
        dateInner.appendChild(el('span', { text: formatDateSafe(article.published_at, FORMAT_DATE_SHORT) }));
        dateWrap.appendChild(dateInner);
        meta.appendChild(dateWrap);

        return meta;
    }

    function buildMedia(article, { ratioClass, sizeClass = '' }) {
        const media = el('div', { className: `post-media panel uc-transition-toggle overflow-hidden ${sizeClass}`.trim() });

        const featured = el('div', { className: `featured-image bg-gray-25 dark:bg-gray-800 ratio ${ratioClass}` });
        const img = el('img', { className: 'uc-transition-scale-up uc-transition-opaque media-cover image' });
        setImage(img, article);
        featured.appendChild(img);
        media.appendChild(featured);

        media.appendChild(el('a', { className: 'position-cover', href: ARTICLE_URL(article.slug) }));

        return media;
    }

    // Big post: image on top (16x9), then category ❘ date meta row, then title.
    // Mirrors the "Global" main article markup in the demo template.
    function renderMainPost(article) {
        const detailsUrl = ARTICLE_URL(article.slug);
        const articleEl = el('article', { className: 'post type-post panel vstack gap-1 lg:gap-2' });

        articleEl.appendChild(buildMedia(article, { ratioClass: 'ratio-16x9' }));

        const header = el('div', { className: 'post-header panel vstack gap-1' });
        header.appendChild(buildMetaRow(article, { includeSeparator: true }));

        const titleEl = el('h3', { className: 'post-title h6 xl:h5 m-0 text-truncate-2 mb-1' });
        titleEl.appendChild(el('a', { className: 'text-none hover:text-primary duration-150', href: detailsUrl, text: article.title }));
        header.appendChild(titleEl);

        articleEl.appendChild(header);

        return articleEl;
    }

    // Compact side post: title + date on the left, small square thumb on the
    // right. Mirrors the "row child-cols g-2" side-post markup in the demo.
    function renderSidePost(article) {
        const detailsUrl = ARTICLE_URL(article.slug);
        const articleEl = el('article', { className: 'post type-post panel' });

        const row = el('div', { className: 'row child-cols g-2 uc-grid' });
        row.setAttribute('data-uc-grid', '');

        // left: title + date
        const left = el('div', { className: 'uc-first-column' });
        const header = el('div', { className: 'post-header panel vstack justify-between gap-1' });

        const titleEl = el('h3', { className: 'post-title h6 m-0 text-truncate-2' });
        titleEl.appendChild(el('a', { className: 'text-none hover:text-primary duration-150', href: detailsUrl, text: article.title }));
        header.appendChild(titleEl);

        const meta = el('div', { className: 'post-meta fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60' });
        const dateInner = el('div', { className: 'post-date hstack gap-narrow' });
        dateInner.appendChild(el('span', { text: formatDateSafe(article.published_at, FORMAT_DATE_SHORT) }));
        meta.appendChild(dateInner);
        header.appendChild(meta);

        left.appendChild(header);
        row.appendChild(left);

        // right: small thumbnail
        const right = el('div', { className: 'col-auto' });
        right.appendChild(buildMedia(article, { ratioClass: 'ratio-1x1', sizeClass: 'max-w-72px min-w-64px lg:min-w-72px' }));
        row.appendChild(right);

        articleEl.appendChild(row);

        return articleEl;
    }

    function timeAgo(isoDate) {
        const seconds = Math.floor((Date.now() - new Date(isoDate).getTime()) / 1000);
        for (const [name, secs] of TIME_AGO_UNITS) {
            const val = Math.floor(seconds / secs);
            if (val >= 1) {
                return name === 'min'
                    ? `${val}min ago`
                    : `${val} ${name}${val > 1 ? 's' : ''} ago`;
            }
        }
        return 'just now';
    }
})();
