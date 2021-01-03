<template>
    <div v-if="isVisible">
        <swapping-squares-spinner
            :animation-duration="1000"
            :size="24"
            :color="'#ffffff'"
        />
    </div>
</template>

<script>
// To use minified css and js files instead of .vue single file components:
// import 'epic-spinners/dist/lib/epic-spinners.min.css'
// import {AtomSpinner} from 'epic-spinners/dist/lib/epic-spinners.min.js'

// To get tree shaking from webpack (won't import all spinners when you only need one)
// import AtomSpinner from 'epic-spinners/src/components/lib/AtomSpinner'

import SwappingSquaresSpinner from 'epic-spinners/src/components/lib/SwappingSquaresSpinner';

export default {
    components: {
        SwappingSquaresSpinner
    },
    props: {
        isVisible: {
            type: Boolean,
            required: true
        }
    }
}
</script>
