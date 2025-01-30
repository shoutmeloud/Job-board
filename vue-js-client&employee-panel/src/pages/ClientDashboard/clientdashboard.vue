<template>
    <div class="container-fluid">
        <div class="row">
            <ClientLeftside />
            <div class="right_side">
                <Header />
                <div class="main_div">
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from '@/components/Main/Header.vue';
import ClientLeftside from '@/components/Main/ClientLeftside.vue';

export default {
    name: 'Dashboard',
    components: {
        Header,
        ClientLeftside
    },  
};
</script>