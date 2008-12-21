<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url): ?>
  <url>
    <loc><?php echo url_for($url->getLoc(), 'absolute=true') ?></loc>
<?php if ($url->getLastmod()): ?>
    <lastmod><?php echo $url->getLastmod() ?></lastmod>
<?php endif ?>
<?php if ($url->getChangefreq()): ?>
    <changefreq><?php echo $url->getChangefreq() ?></changefreq>
<?php endif ?>
<?php if ($url->getPriority()): ?>
    <priority><?php echo $url->getPriority() ?></priority>
<?php endif ?>
  </url>
<?php endforeach ?>
</urlset>