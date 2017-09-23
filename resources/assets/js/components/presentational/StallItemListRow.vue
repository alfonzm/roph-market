<template>
    <tr class="stall-item-row">
        <td class="img">
            <ro-item-image :id="stallItem.ro_item_id" :type="stallItem.ro_item.type" />
        </td>
        <td class="name">
            <a :href="linkToStall ? `/stalls/${stallItem.stall_id}` : `/search?s=${stallItem.ro_item_id}`">
                <ro-item-name :refine="stallItem.refine" :ro-item="stallItem.ro_item" />
            </a>
            <template v-if="stallItem.cards.length > 0">
                – <span class="item-cards" v-html="stringifyCards(stallItem.cards)"></span>
            </template>
        </td>
        <td class="quantity">
            {{ stallItem.quantity }}x
        </td>
        <td class="price">
            <template v-if="stallItem.price">
                {{ stallItem.price }}z
            </template>
            <template v-else>
                --
            </template>
        </td>
        <td v-if="linkToStall" class="link-to-stall">
            <a :href="`/stalls/${stallItem.stall_id}`"><i class="fa fa-external-link"></i></a>
        </td>
        <td v-if="timestamp" class="timestamp">
            {{ timeAgo(stallItem.updated_at) }}
        </td>
    </tr>
</template>

<script>
import RoItemImage from './RoItemImage.vue'
import RoItemName from './RoItemName.vue'
import moment from 'moment'

export default {
    props: ['stallItem', 'timestamp', 'linkToStall'],
    components: {
        'ro-item-image': RoItemImage,
        'ro-item-name': RoItemName
    },
    methods: {
        // receive array of StallItemCard.php objects
        stringifyCards(cards) {
            return cards.map(card => `<a href='/search?s=${card.ro_item.id}'>${card.ro_item.name}</a>`).join(", ")
        },
        timeAgo: function(date) {
            return moment(date).fromNow();
        }
    }
}
</script>