{extends file="layouts/main.tpl"}
{block name="content"}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">{$category->getName()->value}</li>
        </ol>
    </nav>

    <h1>{$category->getName()->value}</h1>
    <p class="text-muted mb-4">{$category->getDescription()}</p>

    <div class="btn-group mb-4">
        <a class="btn btn-outline-primary {if $sort == 'date'}active{/if}" href="?sort=date">Newest</a>
        <a class="btn btn-outline-primary {if $sort == 'views'}active{/if}" href="?sort=views">Most viewed</a>
    </div>

    <div class="row g-4">
        {foreach $articles as $article}
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    {if $article->getImagePath()}
                        <img src="/uploads/{$article->getImagePath()}" class="card-img-top" alt="{$article->getTitle()->value}">
                    {/if}
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-decoration-none" href="/article/{$article->getSlug()->value}">{$article->getTitle()->value}</a>
                        </h5>
                        <p class="card-text">{$article->getDescription()}</p>
                    </div>
                    <div class="card-footer text-muted small">
                        {$article->getCreatedAt()->format('d.m.Y')} &middot; {$article->getViews()} views
                    </div>
                </div>
            </div>
        {foreachelse}
            <p>No articles in this category.</p>
        {/foreach}
    </div>

    {if $pagination.total > 1}
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item {if $pagination.current <= 1}disabled{/if}">
                    <a class="page-link" href="?sort={$sort}&page={$pagination.current - 1}">Previous</a>
                </li>
                {section name=p loop=$pagination.total}
                    <li class="page-item {if $smarty.section.p.iteration == $pagination.current}active{/if}">
                        <a class="page-link" href="?sort={$sort}&page={$smarty.section.p.iteration}">{$smarty.section.p.iteration}</a>
                    </li>
                {/section}
                <li class="page-item {if $pagination.current >= $pagination.total}disabled{/if}">
                    <a class="page-link" href="?sort={$sort}&page={$pagination.current + 1}">Next</a>
                </li>
            </ul>
        </nav>
    {/if}
{/block}
