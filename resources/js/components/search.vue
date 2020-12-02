<template>
    <div>
        <a @click.prevent="search=!search" class="btn btn-outline-success">
            <i class="fa fa-search" v-if="search==false"></i>
            <i class="fa fa-times" v-if="search==true"></i>
        </a>
        <form class="form-inline my-2 my-lg-0 searchBar" v-if="search" >
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"  >
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            search
         </button>
        </form>
    </div>
</template>

<script>

    export default {
        data(){
            return{
                search:false,
            }
        },
        methods:{

        }
    }

</script>
