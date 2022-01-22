<accordian :title="'{{ __('amooati-co::app.admin.catalog.product.customizable-options') }}'" :active="true">
    <div slot="body">
        <customizable-options></customizable-options>
    </div>
</accordian>

@push('scripts')
    <script type="text/x-template" id="c-option">
        <div class="mt-10">
            <div>
                <button id="add-customizable-option-btn" type="button" class="btn btn-primary" @click="remove">X
                </button>
            </div>
            <label class="mt-10">{{ __('amooati-co::app.admin.catalog.product.text') }}</label>
            <select class="control" id="c-option-select" @change="typeChanged($event)">
                <option></option>
                <option value="text">{{ __('amooati-co::app.admin.catalog.product.text') }}</option>
            </select>
            <div class="field-wrapper">
                <div v-if="type == 'text'">
                    <div class="control-group boolean">
                        <label for="new">
                            {{ __('amooati-co::app.admin.catalog.product.required') }}
                        </label>
                        <label class="switch">
                            <input type="checkbox" :id="`co[` + this.id + `]['required']`"
                                   :name="`co[` + this.id + `]['required']`"
                                   data-vv-as="&quot;{{ __('amooati-co::app.admin.catalog.product.required') }}&quot;"
                                   value="1" class="control">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('c-option', {

            template: '#c-option',

            props: {
                id: {
                    type: String
                }
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
                <button id="add-customizable-option-btn" type="button" class="btn btn-primary"
                        @click="AddNew()">{{ __('amooati-co::app.admin.catalog.product.add') }}</button>
            </div>
            <div id="customizable-options-wrapper" class="control-group">
                <c-option v-for="(option, index) in options" :id="option"></c-option>
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
            },

            methods: {
                AddNew: function () {
                    this.count++;
                    this.options.push(this.count)
                },
            },

        })
    </script>
@endpush