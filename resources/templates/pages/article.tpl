{extends file="layouts/main.tpl"}
{block name="content"}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">{$article->getTitle()->value}</li>
        </ol>
    </nav>

    <article class="card shadow-sm mb-4">
        {if $article->getImagePath()}
            <img src="/uploads/{$article->getImagePath()}" class="card-img-top" alt="{$article->getTitle()->value}">
        {/if}
        <div class="card-body">
            <h1 class="card-title">{$article->getTitle()->value}</h1>
            <p class="text-muted small">{$article->getCreatedAt()->format('d.m.Y')} &middot; {$article->getViews()} views</p>
            <p class="lead">{$article->getDescription()}</p>
            <div>{$article->getContent()}</div>
        </div>
    </article>

    {if $related}
        <h4 class="mb-3">Related articles</h4>
        <div class="row g-3">
            {foreach $related as $rel}
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <a class="text-decoration-none" href="/article/{$rel->getSlug()->value}">{$rel->getTitle()->value}</a>
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
    {/if}
{/block}
