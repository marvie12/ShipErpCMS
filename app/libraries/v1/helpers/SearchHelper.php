<?php

class SearchHelper extends BaseHelper
{
    /**
     * Data for search feed
     * @param  array    $article    article data
     * @return string               object
     */
    public static function transformSearchFeed($article)
    {
        $entities = null;
        $authors = $article->propAuthors->toArray();
        $authors = array_map(function($item){return array_only($item, ['name', 'url']); }, $authors);

        return (object) [
                'siteId'                 => getenv('WEBSITE_ID'),
                'article_id'             => (int) $article->article_id,
                'article_title'          => strip_tags(html_entity_decode($article->getTitle()), '<em>'),
                'article_blurb'          => $article->getBlurb(),
                'article_content'        => null,
                'url'                    => $article->makeMainArticleLink(),
                'section_name'           => $article->section->name,
                'article_date_published' => $article->article_date_published,
                'article_main_image'     => $article->article_image,
                'meta_title'             => $article->morphMetaTag->title,
                'meta_description'       => $article->morphMetaTag->description,
                'keywords'               => $article->morphMetaTag->keyword,
                'custom_1'               => 'article',
                'custom_2'               => json_encode($authors),
                'custom_4'               => json_encode($entities)
            ];
    }
}
