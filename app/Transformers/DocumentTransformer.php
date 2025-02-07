<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Document;

/**
 * Class DocumentTransformer.
 *
 * @package namespace App\Transformers;
 */
class DocumentTransformer extends TransformerAbstract
{
    /**
     * Transform the Document entity.
     *
     * @param \App\Entities\Document $model
     *
     * @return array
     */
    public function transform(Document $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
