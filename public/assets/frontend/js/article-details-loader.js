// public/assets/frontend/js/article-details-loader.js
(function () {
    const FALLBACK_IMAGE = '/assets/frontend/images/placeholder-hero.jpg';

    document.addEventListener('DOMContentLoaded', () => {
        const page = document.querySelector('[data-page="article-details"]');
        if (!page) return;

        const slug = page.dataset.slug;
        if (!slug) return;

        apiClient.get(`/articles/${slug}`)
            .then(({ data }) => {
                if (data.data) renderArticle(page, data.data);
                if (data.related) renderRelated(page, data.related);
            })
            .catch((err) => {
                if (err.response?.status === 404) {
                    window.location.href = '/404';
                }
                // otherwise keep static markup as fallback
            });
    });

    function renderArticle(el, a) {
        const titleEl = el.querySelector('[data-field="title"]');
        if (titleEl) titleEl.textContent = a.title;

        document.title = `${a.seo_title_resolved ?? a.title} — ${document.title.split(' — ').pop()}`;

        const img = el.querySelector('[data-field="image"]');
        if (img) {
            img.src = a.featured_image || FALLBACK_IMAGE;
            img.alt = a.title ?? '';
        }

        const bodyEl = el.querySelector('[data-field="body"]');
        if (bodyEl) bodyEl.innerHTML = a.body ?? '';

        const excerptEl = el.querySelector('[data-field="excerpt"]');
        if (excerptEl) excerptEl.textContent = a.excerpt ?? '';

        if (a.category) {
            const cat = el.querySelector('[data-field="category"]');
            if (cat) {
                cat.textContent = a.category.name;
                cat.href = `/category/${a.category.slug}`;
            }
        }

        if (a.author) {
            const authorName = el.querySelector('[data-field="author-name"]');
            if (authorName) authorName.textContent = a.author.name;
        }

        const dateEl = el.querySelector('[data-field="date"]');
        if (dateEl) {
            dateEl.textContent = a.published_at
                ? new Date(a.published_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
                : '';
        }

        const canonical = el.querySelector('link[rel="canonical"]');
        if (canonical) canonical.href = a.canonical_url || window.location.href;
    }

    function renderRelated(el, related) {
        const wrap = el.querySelector('[data-field="related-list"]');
        if (!wrap || !related.length) return;

        wrap.innerHTML = related.map(r => `
            <div>
                <article class="post type-post panel vstack gap-2">
                    <figure class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                            src="${r.featured_image || FALLBACK_IMAGE}" alt="${escapeHtml(r.title)}">
                        <a href="/news-deatils/${r.slug}" class="position-cover" data-caption="${escapeHtml(r.title)}"></a>
                    </figure>
                    <div class="post-header panel vstack gap-1">
                        <h5 class="h6 md:h5 m-0">
                            <a class="text-none" href="/news-deatils/${r.slug}">${escapeHtml(r.title)}</a>
                        </h5>
                        <div class="post-date hstack gap-narrow fs-7 opacity-60">
                            <span>${r.published_at ? new Date(r.published_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : ''}</span>
                        </div>
                    </div>
                </article>
            </div>
        `).join('');
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }
})();
