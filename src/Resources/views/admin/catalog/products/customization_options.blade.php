<?php
$customizationOptions = [];
$customizationOptions = app()->make(\AmooAti\CustomizableOption\Repositories\ProductOptionRepository::class)->where('product_id', $product->id)->get();
$customizationOptions = $customizationOptions->map(function ($item) {
    return [
        'option_id'      => $item->id,
        'type'           => $item->type,
        'title'           => $item->translate(core()->getRequestedLocaleCode())->title,
        'required'       => $item->required,
        'max_characters' => $item->max_characters,
        'position'       => $item->position,
        'price'          => $item->price,

    ];
});
?>


<accordian title="{{ __('amooati-co::app.admin.product.customization-options.customization-options') }}"
           :active="{{'false'}}">
    <div slot="body">
        <customizable-options></customizable-options>

    </div>
</accordian>


@push('scripts')
    <script type="text/x-template" id="c-option">
        <div class="mt-10">
            <div class="row">
                <label
                    class="mt-10">{{ __('amooati-co::app.admin.product.customization-options.type') }}</label>
                <select class="control" id="c-option-select" @change="typeChanged($event)" v-model="option.type">
                    <option></option>
                    <option
                        value="text">{{ __('amooati-co::app.admin.product.customization-options.text') }}</option>
                </select>
                <div>
                    <button id="add-customizable-option-btn" type="button" class="btn btn-lg btn-primary" @click="remove">
                        {{ __('amooati-co::app.admin.product.customization-options.remove') }}
                    </button>
                </div>
            </div>
            <div class="field-wrapper">
                <div v-if="option.type == 'text'">
                    <div class="control-group boolean row">
                        <input type="hidden" :name="`co[` + option.id + `][option_id]`" :value="option.option_id">
                        <label>
                            {{ __('amooati-co::app.admin.product.customization-options.required') }}
                        </label>
                        <label class="switch">
                            <input type="checkbox" :id="`co[` + option.id + `][required]`"
                                   :name="`co[` + option.id + `][required]`" v-model="option.required"
                                   value="1" class="control">
                            <span class="slider round"></span>
                        </label>
                        <label>{{ __('amooati-co::app.admin.product.customization-options.title') }}</label>
                        <input type="text" class="control" :id="`co[` + option.id + `][title]`"
                               :name="`co[` + option.id + `][name]`" v-model="option.title"
                               v-validate="'required'"
                               data-vv-as="&quot;{{ __('amooati-co::app.admin.product.customization-options.field-name') }}&quot;">
                        <label>{{ __('amooati-co::app.admin.product.customization-options.max-characters') }}</label>
                        <input type="number" class="control" :id="`co[` + option.id + `][max_characters]`"
                               :name="`co[` + option.id + `][max_characters]`" v-model="option.max_characters"
                               v-validate="'required|numeric|min:1'"
                               data-vv-as="&quot;{{ __('amooati-co::app.admin.product.customization-options.max-chars') }}&quot;">
                        <label>{{ __('amooati-co::app.admin.product.customization-options.price') }}</label>
                        <input type="number" class="control" :id="`co[` + option.id + `][price]`"
                               :name="`co[` + option.id + `][price]`" v-model="option.price"
                               v-validate="'required|min:0'"
                               data-vv-as="&quot;{{ __('amooati-co::app.admin.product.customization-options.price') }}&quot;">
                        <label>{{ __('admin::app.catalog.products.sort-order') }}</label>
                        <input type="number" class="control" :id="`co[` + option.id + `][position]`"
                               :name="`co[` + option.id + `][position]`" :value="option.position"
                               v-validate="'required|numeric|min:0'"
                               data-vv-as="&quot;{{ __('admin::app.catalog.products.sort-order') }}&quot;">
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('c-option', {

            template: '#c-option',

            inject: ['$validator'],

            props: {
                option: Object
            },

            data() {
                return {
                    type: ''
                }
            },

            methods: {
                remove: function () {
                    this.$destroy();
                    this.$el.parentNode.removeChild(this.$el);
                    this.$root.$emit('deleteOption', this.id);
                },
                typeChanged: function (e) {
                    switch (e.target.options.selectedIndex) {
                        case 1:
                            this.type = 'text';
                            break;

                        default:
                            this.type = '';
                    }
                }
            }
        })

    </script>

    <script type="text/x-template" id="customizable-options">
        <div>
            <div>
                <button id="add-customizable-option-btn" type="button" class="btn btn-lg btn-primary"
                        @click="AddNew()">{{ __('amooati-co::app.admin.product.customization-options.add') }}</button>
            </div>
            <div id="customizable-options-wrapper" class="control-group">
                <c-option v-for="(option, index) in options" :option="option"></c-option>
            </div>
        </div>

    </script>

    <script>
        Vue.component('customizable-options', {

            template: '#customizable-options',

            data() {
                return {
                    options: [],
                    count: 0,
                }
            },

            mounted: function () {
                this.$root.$on('deleteOption', (optionId) => {
                    this.count--;
                })

                this.options = {!! $customizationOptions !!}
                this.options.forEach(function (option) {
                    this.count++;
                    option.id = this.count;
                }.bind(this));
            },

            methods: {
                AddNew: function () {
                    this.count++;
                    this.options.push({id: this.count, type: '', title: '', price: 0, position: 0, required: 0});
                },
            },

        })
    </script>
@endpush