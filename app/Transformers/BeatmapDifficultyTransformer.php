<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Transformers;

use App\Models\Beatmap;
use App\Models\Score\Best\Model as ScoreBestModel;
use League\Fractal;

class BeatmapDifficultyTransformer extends Fractal\TransformerAbstract
{
    protected $availableIncludes = [
        'scoresBest',
        'failtimes',
    ];

    public function transform(Beatmap $b)
    {
        return [
            'beatmap_id' => $b->beatmap_id,
            'mode' => $b->playmode,
            'rating' => $b->difficultyrating,
            'name' => $b->version,
            'cs' => $b->diff_size,
            'drain' => $b->diff_drain,
            'accuracy' => $b->diff_overall,
            'ar' => $b->diff_approach,
            'length' => $b->total_length,
            'playcount' => $b->playcount,
            'passcount' => $b->passcount,
        ];
    }

    public function includeScoresBest(Beatmap $b)
    {
        $scores = $b
            ->scoresBest()
            ->orderBy('score', 'desc')
            ->limit(50)
            ->get();

        return $this->collection($scores, new ScoreTransformer);
    }

    public function includeFailtimes(Beatmap $b)
    {
        return $this->collection($b->failtimes, new BeatmapFailtimesTransformer);
    }
}
