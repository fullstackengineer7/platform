{extends file="layouts/main.tpl"}
{block name="content"}
    <h1 class="mb-4">Categories</h1>
    <div class="row g-4">
        {foreach $items as $item}
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-decoration-none" href="/category/{$item.category->getSlug()->value}">{$item.category->getName()->value}</a>
                        </h5>
                        <p class="text-muted">{$item.category->getDescription()}</p>
                        <h6>Latest articles</h6>
                        <ul class="list-unstyled mb-0">
                            {foreach $item.articles as $article}
                                <li class="mb-1"><a href="/article/{$article->getSlug()->value}">{$article->getTitle()->value}</a></li>
                            {foreachelse}
                                <li class="text-muted">No articles yet</li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
        {foreachelse}
            <p>No categories yet.</p>
        {/foreach}
    </div>
{/block}
