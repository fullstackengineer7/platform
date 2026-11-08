{block name="content"}
    <div class="category-detail">
        <h1>{$category->getName()->value}</h1>
        <p class="category-desc">{$category->getDescription()}</p>

        <div class="articles-list">
            {foreach $articles as $article}
                <div class="article-card">
                    <h2><a href="/article/{$article->getSlug()->value}">{$article->getTitle()->value}</a></h2>
                    <p>{$article->getDescription()}</p>
                    <div class="article-meta">
                        <span>{$article->getCreatedAt()->format('d.m.Y')}</span> |
                        <span>{$article->getViews()} views</span>
                    </div>
                </div>
            {/foreach}
        </div>

        {if $pagination}
            <div class="pagination">
                {if $pagination->hasPrevious()}
                    <a href="{$pagination->getPreviousUrl()}">Previous</a>
                {/if}
                <span>Page {$pagination->getCurrentPage()} of {$pagination->getTotalPages()}</span>
                {if $pagination->hasNext()}
                    <a href="{$pagination->getNextUrl()}">Next</a>
                {/if}
            </div>
        {/if}
    </div>
{/block}
