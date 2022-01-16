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
            <label class="mt-10">Type</label>
            <select class="control">
                <option></option>
                <option>Text</option>
            </select>
        </div>
    </script>

    <script>
        Vue.component('c-option', {

            template: '#c-option',

            methods: {
                remove: function () {
                    this.$destroy();
                    this.$el.parentNode.removeChild(this.$el);
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
                <c-option v-for="(option, index) in options"></c-option>
            </div>
        </div>

    </script>

    <script>
        Vue.component('customizable-options', {

            template: '#customizable-options',

            data() {
                return {
                    options: []
                }
            },
            methods: {
                AddNew: function () {
                    this.options.push('something')
                }
            }

        })
    </script>
@endpush