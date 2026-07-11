<header>
    <a href="$BaseURL">$SiteConfig.Title</a>
    <nav aria-label="Main">
        <ul>
            <% loop $Menu(1) %>
                <li><a href="$Link">$MenuTitle</a></li>
            <% end_loop %>
        </ul>
    </nav>
</header>
