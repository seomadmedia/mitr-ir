(function($) {
    window.addEventListener('elementor/init', () => {

        var SelectApiControl = elementor.modules.controls.BaseData.extend({

            onReady() {
                let self = this;
                let $el = this.$el.find('select.mweb-selectapi');
                let source = $el.data('source');
                let selectedIds = this.getControlValue() || [];

                if (selectedIds.length > 0) {
                    $.ajax({
                        url: mweb_selectapi.ajax_url,
                        dataType: 'json',
                        data: {
                            action: 'mweb_selectapi_source',
                            source: source,
                            nonce: mweb_selectapi.nonce,
                            ids: Array.isArray(selectedIds) ? selectedIds.join(',') : selectedIds
                        },
                        success: function (data) {
                            if (data.results) {
                                data.results.forEach(item => {
                                    let option = new Option(item.text, item.id, true, true);
                                    $el.append(option);
                                });
                                initSelect2();
                            }
                        }
                    });
                } else {
                    initSelect2();
                }

                function initSelect2() {
                    if (!$el.hasClass('select2-initialized')) {
                        $el.select2({
                            dir: "rtl",
                            ajax: {
                                url: mweb_selectapi.ajax_url,
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    return {
                                        action: 'mweb_selectapi_source',
                                        source: source,
                                        nonce: mweb_selectapi.nonce,
                                        s: params.term || ''
                                        // ids برای جستجو فرستاده نمی شود
                                    };
                                },
                                processResults: function (data) {
                                    // حذف آیتم‌هایی که قبلاً انتخاب شده‌اند
                                    if (data.results && selectedIds.length > 0) {
                                        data.results = data.results.filter(item => !selectedIds.includes(String(item.id)));
                                    }
                                    return { results: data.results };
                                },
                                cache: true
                            },
                            placeholder: $el.data('placeholder') ?? 'جستجو ...',
                            minimumInputLength: 2,
                            width: '100%'
                        }).on('change', function () {
                            selectedIds = $(this).val() || [];
                            self.saveValue();
                        });

                        $el.addClass('select2-initialized');
                    }
                }
            },

            saveValue() {
                let $el = this.$el.find('select.mweb-selectapi');
                this.setValue($el.val());
            },

            onBeforeDestroy() {
                this.saveValue();
            }

        });

        elementor.addControlView('selectapi', SelectApiControl);
    });
}(jQuery));
