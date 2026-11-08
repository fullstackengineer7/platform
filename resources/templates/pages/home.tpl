{block name="content"}
    <div class="home-container">
        <h1>Welcome to our Blog</h1>
        <div class="categories-grid">
            {foreach $categories as $category}
                <div class="category-card">
                    <h2><a href="/category/{$category->getSlug()->value}">{$category->getName()->value}</a></h2>
                    <p>{$category->getDescription()}</p>
                    <div class="latest-articles">
                        <h3>Latest Articles:</h3>
                        <ul>
                            {foreach $category->articles as $article}
                                <li><a href="/article/{$article->getSlug()->value}">{$article->getTitle()->value}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
{/block}
