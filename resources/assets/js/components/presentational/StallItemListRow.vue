<template>
    <tr class="stall-item-row">
        <td class="img">
            <ro-item-image :id="stallItem.ro_item_id" :type="stallItem.ro_item.type" />
        </td>
        <td class="name">
            <a :href="`/search?s=${stallItem.ro_item_id}`">
                <ro-item-name :refine="stallItem.refine" :ro-item="stallItem.ro_item" :modifier="stallItem.modifier" />
            </a>
            <template v-if="stallItem.cards.length > 0">
                – <span class="item-cards" v-html="stringifyCards(stallItem.cards)"></span>
            </template>
        </td>
        <!-- Stall type image and stall username -->
        <template v-if="linkToStall">
            <td class="img">
                <a :href="`/stalls/${stallItem.stall_id}`">
                    <img :src="`/img/${stallItem.stall.type}.png`"/>
                </a>
            </td>
            <td class="link-to-stall">
                <a :href="`/stalls/${stallItem.stall_id}`">
                    {{ stallItem.stall.user.name }}
                </a>
            </td>
        </template>
        <td class="quantity">
            {{ stallItem.quantity | comma }}
        </td>
        <td class="price">
            <template v-if="stallItem.price">
                <item-price :value="stallItem.price" />
            </template>
            <template v-else>
                --
            </template>
        </td>
        <td v-if="timestamp" class="timestamp">
            {{ timeAgo(stallItem.updated_at) }}
        </td>
    </tr>
</template>

<script>
import ItemPrice from './ItemPrice.vue'
import RoItemImage from './RoItemImage.vue'
import RoItemName from './RoItemName.vue'
import moment from 'moment'
import numeral from 'numeral'

export default {
    props: ['stallItem', 'timestamp', 'linkToStall'],
    components: {
        'ro-item-image': RoItemImage,
        'ro-item-name': RoItemName,
        'item-price': ItemPrice
    },
    filters: {
        comma: function(number) {
            return numeral(number).format('0,0');
        }
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