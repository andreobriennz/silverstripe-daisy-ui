<!doctype html>
<html lang="$ContentLocale">
<head>
    <% base_tag %>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    $MetaTags(false)
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> | $SiteConfig.Title</title>
</head>
<body>
    <% include Header %>
    <main id="main">
        $Layout
    </main>
    <% include Footer %>
    <% if $HasPerm('CMS_ACCESS') %>$SilverStripeNavigator<% end_if %>
</body>
</html>
