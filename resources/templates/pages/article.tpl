{block name="content"}
    <div class="article-detail">
        <header class="article-header">
            <h1>{$article->getTitle()->value}</h1>
            <div class="meta">
                <span>Date: {$article->getCreatedAt()->format('d.m.Y')}</span> |
                <span>Views: {$article->getViews()}</span>
            </div>
        </header>

        {if $article->getImagePath()}
            <img src="/uploads/{$article->getImagePath()}" class="article-image" alt="{$article->getTitle()->value}">
        {/if}

        <div class="article-description">
            <p class="lead">{$article->getDescription()}</p>
        </div>

        <div class="article-content">
            {$article->getContent()}
        </div>

        <div class="related-articles">
            <h3>Related Articles</h3>
            <div class="related-grid">
                {foreach $related as $relArticle}
                    <div class="related-card">
                        <a href="/article/{$relArticle->getSlug()->value}">{$relArticle->getTitle()->value}</a>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
{/block}
