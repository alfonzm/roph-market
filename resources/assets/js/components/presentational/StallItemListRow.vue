<template>
    <tr class="stall-item-row">
        <td class="img">
            <ro-item-image :id="stallItem.ro_item_id" :type="stallItem.ro_item.type" />
        </td>
        <td class="name">
            <a :href="`/ro-items/${stallItem.ro_item_id}`">
                {{ stallItem.ro_item.name }} <template v-if="stallItem.ro_item.slots > 0">[{{ stallItem.ro_item.slots }}]</template>
            </a>
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

export default {
    props: ['stallItem'],
    components: {
        'ro-item-image': RoItemImage
    },
}
</script>