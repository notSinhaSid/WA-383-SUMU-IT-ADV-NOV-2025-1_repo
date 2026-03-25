<!-- Show search bar on dashboard and browse pages only -->
<?php if (isset($navPage) && ($navPage == 'dashboard' || $navPage == 'browse')): ?>
    <form class="d-flex me-3" id="searchForm">
        <input
            type="text"
            id="searchInput"
            name="search"
            class="form-control form-control-sm"
            placeholder="Search posts..."
            style="width:220px;">
        <button class="btn btn-outline-secondary btn-sm ms-2" type="submit" id="searchBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    </form>
<?php endif; ?>