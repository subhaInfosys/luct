<?php namespace App\Http\Transformers;
use App\Http\Transformers\Transformer;
use URL;

/**
 * Class ArticleTransformer
 * @package App\Http\Transformers
 */
class ArticleTransformer extends Transformer
{
    /**
     * Transform Data
     *
     * @param $data
     * @return array
     */
    public function transform($data)
    {
        return [
            'id'                => $this->nulltoBlank($data['id']),
            'name'              => $this->nulltoBlank($data['name']),
            'date'              => $this->nulltoBlank($data['date']),
            'thumbnail'         => $this->nulltoBlank($data['thumbnail']),
            'thumbnail_small'   => $this->nulltoBlank($data['thumbnail_small']),
            'description'       => $this->nulltoBlank($data['description']),
            'share'             => $this->nulltoBlank($data['share']),
            'bookmarked'        => $data['bookmarked'] ? 1 : 0
        ];
    }

    public function transformSingle($data)
    {

        return [
            'title'             => $this->nulltoBlank($data['title']),
            'date'              => $this->nulltoBlank($data['date']),
            'share'             => $this->nulltoBlank($data['share']),
            'body'              => $this->nulltoBlank($data['body']),
            'image'             => $this->nulltoBlank($data['picture']['@attributes']['main']),
            'gallery'           => $this->getGalleryPictures($data),
            'bookmarked'        => $data['bookmarked'] ? 1 : 0
        ];
    }

    public function getGalleryPictures($data)
    {
        $imageList = [];

        if(isset($data['picture']['gallerypic']) && !empty($data['picture']['gallerypic']))
        {
            foreach($data['picture']['gallerypic'] as $singlePictureArray)
            {
                $imageList[] = $singlePictureArray['@attributes']['url'];
            }
        }

        return $imageList;
    }

    public function transformDiscoverMalaysia($data)
    {
        return [
            'country_name'              => $this->nulltoBlank($data['@attributes']['name']),
            'image'                     => $this->nulltoBlank($data['discover']['@attributes']['image']),
            'about_country_billboard'   => $this->nulltoBlank($data['discover']['about_country_billboard']),
            'about_country_experience'   => $this->nulltoBlank($data['discover']['about_country_experience']),
        ];
    }
}