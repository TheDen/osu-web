###
# Copyright 2015-2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, span} = React.DOM
el = React.createElement

class BeatmapsetPage.Stats extends React.Component
  render: ->
    div className: 'beatmapset-header__stats-box',
      div className: 'beatmapset-header__stats-row beatmapset-header__stats-row--basic',
        for stat in ['total_length', 'bpm', 'count_circles', 'count_sliders']
          value = if stat == 'bpm' then @props.beatmapset.bpm else @props.beatmap[stat]

          if stat == 'total_length'
            value = moment(0).seconds(value).format('m:ss')

          div
            className: 'beatmapset-header__stat-basic'
            key: stat
            title: osu.trans "beatmaps.beatmapset.show.stats.#{stat}"
            div
              className: 'beatmapset-header__stat-basic-icon'
              style:
                backgroundImage: "url(/images/layout/beatmapset-page/#{stat}.svg)"
            span className: 'beatmapset-header__stat-basic-value', value.toLocaleString()

      div className: 'beatmapset-header__stats-row beatmapset-header__stats-row--advanced',
        for stat in ['cs', 'drain', 'accuracy', 'ar', 'stars']
          value = if stat == 'stars'
            @props.beatmap.difficulty_rating.toFixed 2
          else
            @props.beatmap[stat]

          div className: 'beatmapset-header__stat-advanced',
            span className: 'beatmapset-header__stats-text beatmapset-header__stats-text--advanced-label', osu.trans "beatmaps.beatmapset.show.stats.#{stat}"
            div className: 'beatmapset-header__stat-advanced-bar',
              div
                className: "beatmapset-header__stat-advanced-bar beatmapset-header__stat-advanced-bar--fill beatmapset-header__stat-advanced-bar--#{stat}"
                style:
                  width: "#{value * 10}%"
            span className: 'beatmapset-header__stats-text beatmapset-header__stats-text--advanced-value', value.toLocaleString()
