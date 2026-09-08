// public/assets/frontend/js/menu-loader.js
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-menu-location]').forEach(loadMenuInto);
});

function loadMenuInto(container) {
    const location = container.dataset.menuLocation;

    apiClient.get(`/menus/${location}`)
        .then(({ data }) => renderMenu(container, data.data.items))
        .catch(() => { container.innerHTML = ''; }); // fail silent, keep layout intact
}

function renderMenu(container, items, isSubmenu = false) {
    const ul = document.createElement('ul');
    ul.className = isSubmenu ? 'nav-y gap-1' : container.dataset.menuClass || 'nav-x gap-2 lg:gap-4';

    items.forEach(item => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = item.resolved_url ?? item.url ?? '#';
        a.textContent = item.label;
        a.target = item.target || '_self';
        li.appendChild(a);

        if (item.children?.length) {
            li.classList.add('uc-parent');
            const submenuWrap = document.createElement('div');
            renderMenu(submenuWrap, item.children, true);
            li.appendChild(submenuWrap);
        }
        ul.appendChild(li);
    });

    container.innerHTML = '';
    container.appendChild(ul);
}
