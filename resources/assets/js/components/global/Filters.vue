<style lang="scss">
    @import '~@/abstracts/_variables.scss';

    div.filters-container{
        background-color: white;
        position: fixed;
        left: 0;
        bottom: 0;
        top: 30px;
        max-width: 550px;
        width: 100%;
        box-shadow: 0 2px 4px 0 rgba(3,27,78,0.10);
        z-index: 99;

        span.clear-filters{
            font-size: 16px;
            color: #3e8f3e;
            font-family: "Lato", sans-serif;
            cursor: pointer;
            display: block;
            float: left;
            margin-bottom: 20px;

            img{
                margin-right: 10px;
                float: left;
                margin-top: 6px;
            }
        }

        input[type="text"].search-filters{
            box-shadow: none;
            border-radius: 3px;
            color: #BABABA;
            font-size: 16px;
            font-family: "Lato", sans-serif;
            background-repeat: no-repeat;
            background-position: 6px;
            padding-left: 35px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        label.filter-label{
            font-family: "Lato", sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            color: black;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        div.location-filter{
            text-align: center;
            font-family: "Lato", sans-serif;
            font-size: 16px;
            color: #3e8f3e;
            border-bottom: 1px solid #3e8f3e;
            border-top: 1px solid #3e8f3e;
            border-left: 1px solid #3e8f3e;
            border-right: 1px solid #3e8f3e;
            width: 30%;
            display: inline-block;
            height: 55px;
            line-height: 55px;
            cursor: pointer;
            margin-bottom: 5px;

            &.active{
                color: white;
                background-color: #3e8f3e;
            }

            &.all-locations{
                border-top-left-radius: 3px;
                border-bottom-left-radius: 3px;
            }

            &.roasters{
                border-left: none;
                border-right: none;
            }

            &.stations{
                border-top-right-radius: 3px;
                border-bottom-right-radius: 3px;
            }
        }

        div.brew-method{
            color: #666666;
            border-radius: 4px;
            background-color: #e4e4e4;
            width: 180px;
            height: 35px;
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 7px;
            cursor: pointer;
            position: relative;

            &.active{
                color: white;
                background-color: #3e8f3e;
            }

            div.brew-method-container{
                position: absolute;
                top: 50%;
                transform: translateY(-50%);

                img.brew-method-icon{
                    display: inline-block;
                    margin-right: 10px;
                    margin-left: 5px;
                    width: 20px;
                    max-height: 30px;
                }

                span.brew-method-name{
                    display: inline-block;
                    width: calc( 100% - 40px);
                    vertical-align: middle;
                }
            }
        }

        span.liked-location-label{
            color: #666666;
            font-size: 16px;
            font-family: "Lato", sans-serif;
            margin-left: 10px;
        }

        div.station-grid-container{
            /*overflow: auto;
            padding-bottom: 10px;*/
        }

        div.close-filters{
            height: 90px;
            width: 23px;
            position: absolute;
            right: -20px;
            background-color: white;
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
            line-height: 90px;
            top: 50%;
            cursor: pointer;
            margin-top: -82px;
            text-align: center;
        }

        span.no-results{
            display: block;
            text-align: center;
            margin-top: 50px;
            color: #666666;
            text-transform: uppercase;
            font-weight: 600;
        }
    }

    /* Small only */
    @media screen and (max-width: 39.9375em) {
        div.filters-container{
            padding-top: 25px;
            overflow-y: auto;

            span.clear-filters{
                display: block;
            }

            div.station-grid-container{
                height: inherit;
            }

            div.close-filters{
                display: none;
            }
        }
    }

    /* Medium only */
    @media screen and (min-width: 40em) and (max-width: 63.9375em) {

    }

    /* Large only */
    @media screen and (min-width: 64em) and (max-width: 74.9375em) {

    }
</style>

<template>
    <transition name="slide-in-left">
        <div class="filters-container" id="filters-container" v-show="showFilters">
            <div class="close-filters" v-on:click="toggleShowFilters()">
                <img src="images/grey-left.svg"/>
            </div>
            <div class="col-md-4 col-md-offset-8">
                <br><br><br><!-- TODO espacio para el menu de cambio -->
            </div>
            <div class="col-md-12" id="text-container">
               <input type="text" class="search-filters form-control" v-model="textSearch" placeholder="Buscar Estaciones"/>
            </div>

            <div id="col-md-12 location-type-container " v-if="alerts.length > 1">
                <div class="">
                    <label class="filter-label">Tipos de alertas</label>
                </div>

                <div class="">
                    <div class="location-filter all-locations" v-bind:class="{ 'active': activeAlertFilter === 'all' }" v-on:click="setActiveAlertFilter('all')" >
                        Todas
                    </div>
                    <div class="location-filter" v-on:click="toggleAlertFilter( alert.code )" v-bind:class="{'active' : activeAlertFilter === alert.code}" v-for="alert in alerts">
                        {{ alert.table }}
                    </div>
                </div>
            </div>

            <div id="brew-methods-container">
                <div class="grid-x grid-padding-x">
                    <div class="large-12 medium-12 small-12 cell">
                        <label class="filter-label">Tipos de Estaciones</label>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-10">
                    <div class="brew-method" v-on:click="toggleTypeStationFilter( type.code )" v-bind:class="{'active' : activeTypeStationFilter.indexOf(type.code) >= 0 }" v-for="type in typeStation">
                        <div class="brew-method-container">
                            <img v-bind:src="'images/alert-icons/type-station-icon.svg'" class="brew-method-icon"/>
                            <span class="brew-method-name">{{ type.name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import { EventBus } from '../../event-bus.js';

    export default {
        components: {},
        data(){
            return {
                textSearch: '',
                activeAlertFilter: 'all',
                activeTypeStationFilter: [],
            }
        },

        watch: {
            textSearch(){
                this.updateFilterDisplay();
            },
            activeAlertFilter(){
                this.updateFilterDisplay();
            },
            activeTypeStationFilter(){
                this.updateFilterDisplay();
            },
        },

        mounted(){
            EventBus.$on('show-filters', function(){
                this.show = true;
            }.bind(this));

            EventBus.$on('clear-filters', function(){
                this.clearFilters();
            }.bind(this));
        },

        computed: {
            showFilters(){
                return this.$store.getters.getShowFilters;
            },
            stations(){
                return this.$store.getters.getStations;
            },
            alerts(){
                return this.$store.getters.getAlerts;
            },
            typeStation(){
                return this.$store.getters.getTypeStation;
            },
            existenceFiltersActive(){
                return this.$store.getters.getExistenceFiltersActive;
            }
        },

        methods: {
            setActiveAlertFilter( filter ){
                this.activeAlertFilter = filter;
            },

            updateFilterDisplay(){

                this.$store.commit('setExistenceFiltersActive',!(this.textSearch === '' && this.activeAlertFilter === 'all' && this.activeTypeStationFilter.length === 0));

                EventBus.$emit('filters-updated', {
                    text: this.textSearch,
                    alert: this.activeAlertFilter,
                    typeStation: this.activeTypeStationFilter
                });
            },

            toggleShowFilters(){
                this.$store.dispatch( 'toggleShowFilters', { showFilters : !this.showFilters } );
            },

            clearFilters(){
                this.textSearch = '';
                this.activeAlertFilter = 'all';
                this.activeTypeStationFilter = [];
            },

            toggleAlertFilter( alert ){
                this.setActiveAlertFilter(alert);
            },

            toggleTypeStationFilter(code){

                var i = this.activeTypeStationFilter.indexOf(code);

                if ( i >= 0 ){
                    this.activeTypeStationFilter.splice(i,1);
                }else {
                    this.activeTypeStationFilter.push(code);
                }
            }
        }
    }
</script>