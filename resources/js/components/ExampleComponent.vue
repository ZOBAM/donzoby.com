<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <b-alert show>Default Alert <b-icon-arrow-up></b-icon-arrow-up></b-alert>
                        I'm an example component. <b-icon icon="battery-full" style="color: #7952b3;"></b-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
