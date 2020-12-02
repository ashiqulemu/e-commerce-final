<!--<template>-->
    <!--<div >-->

        <!--<div class="product" v-for="lat in latest">-->
            <!--<div class="photo">-->
                <!--<img src="url('images/products/'.{{lat.product_image}})"  >-->
            <!--</div>-->
            <!--<div class="base">-->
                <!--<p class="title">{{lat}}</p>-->
                <!--<div class="inner">-->
                    <!--<div class="weight">500mg </div>-->
                    <!--<div class="price">{{lat.price}}</div>-->
                <!--</div>-->
                <!--<div class="addCart">-->
                    <!--<button class="addTocart" @click.prevent="addCart()">-->
                        <!--<span class="item" v-if="latest > 0 ">-->
                            <!--{{latest.name}}-->
                        <!--</span>-->
                        <!--<i class="fa fa-shopping-cart mr-2"  v-if="latest == 0"></i>-->
                        <!--Add To Cart-->

                    <!--</button>-->
                    <!--<button class="decr fa fa-minus" @click.prevent="removeItem" v-if="latest>=1"></button>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
<!--</template>-->

<!--<script>-->
    <!--export default {-->

        <!--data(){-->
            <!--return{-->
                <!--lat:0,-->

            <!--}-->
        <!--},-->
        <!--methods:{-->

            <!--addCart(){-->
                <!--this.latest ++;-->
            <!--},-->

            <!--removeItem(){-->
                <!--this.latest &#45;&#45;;-->
            <!--},-->

        <!--},-->
        <!--computed:{-->

        <!--}-->
    <!--}-->
<!--</script>-->