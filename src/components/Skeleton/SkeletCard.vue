<template>
    <div>
        <Skeleton width="19,5rem" height="10rem">
            <Skeleton width="5" height="5rem">

            </Skeleton>
        </Skeleton>
    </div>
</template>

<script>
import Skeleton from 'primevue/skeleton';
export default {
    name: 'SkeletCard',
    components: { Skeleton },
    data() {
        return {

        };
    },
}
</script>
