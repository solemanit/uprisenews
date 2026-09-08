// public/assets/frontend/js/category-articles-loader.js
document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('category-articles-root');
    if (!root) return;

    const slug = root.dataset.categorySlug;
    loadCategoryArticles(slug, 1);
});

function loadCategoryArticles(slug, page = 1) {
    const list = document.getElementById('category-articles-list');
    const empty = document.getElementById('category-articles-empty');
    const pag = document.getElementById('category-articles-pagination');

    apiClient.get(`/categories/${slug}/articles`, { params: { page } })
        .then(({ data }) => {
            updateCategoryTitle(data.category);
            renderArticles(data.data);
            renderPagination(data.meta, slug);

            empty.classList.toggle('d-none', data.data.length > 0);
        })
        .catch((err) => {
            if (err.response?.status === 404) {
                list.innerHTML = '';
                pag.innerHTML = '';
                empty.classList.remove('d-none');
                empty.querySelector('p').textContent = 'এই ক্যাটাগরিটি খুঁজে পাওয়া যায়নি।';
            }
        });
}

function updateCategoryTitle(category) {
    const titleEl = document.getElementById('category-title');
    if (titleEl && category?.name) {
        titleEl.textContent = category.name;
        document.title = `${category.name} — ${document.title.split('—').pop().trim()}`;
    }
}

function renderArticles(articles) {
    const list = document.getElementById('category-articles-list');

    if (!articles.length) {
        list.innerHTML = '';
        return;
    }

    list.innerHTML = articles.map(article => `
        <div>
            <article class="post type-post panel vstack gap-2">
                <div class="post-image panel overflow-hidden">
                    <figure class="featured-image m-0 ratio ratio-16x9 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                             src="${article.featured_image ?? '/assets/images/common/img-fallback.png'}"
                             alt="${escapeHtml(article.title)}"
                             loading="lazy">
                        <a href="/news-deatils/${article.slug}" class="position-cover"></a>
                    </figure>
                    <div class="post-category hstack gap-narrow position-absolute top-0 start-0 m-1 fs-7 fw-bold h-24px px-1 rounded-1 shadow-xs bg-white text-primary">
                        <a class="text-none" href="/category/${article.category?.slug ?? ''}">${escapeHtml(article.category?.name ?? '')}</a>
                    </div>
                </div>
                <div class="post-header panel vstack gap-1 lg:gap-2">
                    <h3 class="post-title h6 sm:h5 m-0 text-truncate-2 m-0">
                        <a class="text-none" href="/news-deatils/${article.slug}">${escapeHtml(article.title)}</a>
                    </h3>
                    <div class="post-meta panel hstack justify-center fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                        <div class="meta">
                            <div class="hstack gap-2">
                                ${article.author ? `
                                <div>
                                    <div class="post-author hstack gap-1">
                                        <span class="text-black dark:text-white fw-bold">${escapeHtml(article.author.name)}</span>
                                    </div>
                                </div>` : ''}
                                <div>
                                    <div class="post-date hstack gap-narrow">
                                        <span>${formatDate(article.published_at)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    `).join('');
}

function renderPagination(meta, slug) {
    const pag = document.getElementById('category-articles-pagination');
    if (!meta || meta.last_page <= 1) {
        pag.innerHTML = '';
        return;
    }

    let links = '';

    links += `<li class="${meta.current_page === 1 ? 'uc-disabled' : ''}">
        <a href="#" data-page="${meta.current_page - 1}"><span class="icon icon-1 unicon-chevron-left"></span></a>
    </li>`;

    for (let p = 1; p <= meta.last_page; p++) {
        links += `<li><a href="#" data-page="${p}" class="${p === meta.current_page ? 'uc-active' : ''}">${p}</a></li>`;
    }

    links += `<li class="${meta.current_page === meta.last_page ? 'uc-disabled' : ''}">
        <a href="#" data-page="${meta.current_page + 1}"><span class="icon icon-1 unicon-chevron-right"></span></a>
    </li>`;

    pag.innerHTML = `<ul class="nav-x uc-pagination hstack gap-1 justify-center ft-secondary" data-uc-margin="">${links}</ul>`;

    pag.querySelectorAll('a[data-page]').forEach(a => {
        a.addEventListener('click', (e) => {
            e.preventDefault();
            const page = parseInt(a.dataset.page, 10);
            if (page < 1 || page > meta.last_page) return;

            loadCategoryArticles(slug, page);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
}

function formatDate(isoString) {
    if (!isoString) return '';
    return new Date(isoString).toLocaleDateString('en-US', {
        month: 'short', day: 'numeric', year: 'numeric',
    });
}

function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}
