<template>
    <tr class="stall-item-row">
        <td class="img">
            <ro-item-image :id="stallItem.ro_item_id" :type="stallItem.ro_item.type" />
        </td>
        <td class="name">
            <a :href="`/ro-items/${stallItem.ro_item_id}`">
                <ro-item-name :refine="stallItem.refine" :ro-item="stallItem.ro_item" />
            </a> <span v-html="stringifyCards(stallItem.cards)"></span>
        </td>
        <td class="quantity">
            {{ stallItem.quantity }}x
        </td>
        <td class="price">
            {{ stallItem.price }} Z
        </td>
    </tr>
</template>

<script>
import RoItemImage from './RoItemImage.vue'
import RoItemName from './RoItemName.vue'

export default {
    props: ['stallItem'],
    components: {
        'ro-item-image': RoItemImage,
        'ro-item-name': RoItemName
    },
    methods: {
        // receive array of StallItemCard.php objects
        stringifyCards(cards) {
            return cards.map(card => "<a href='#'>" + card.ro_item.name + "</a>").join(", ")
        }
    }
}
</script>