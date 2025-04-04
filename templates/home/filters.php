<section class="filters | content-grid">
    <div class="filters__wrapper" 
        hx-target="#actions-list" 
        hx-swap="outerHTML"
        hx-indicator="#actions-list"
    >

        <div class="filters__header js-filter-toggle">
            <div class="filters__header-wrapper">
                <h3 class="filters__title">
                    <?php get_template_part('svg/icon-filter'); ?>
                    Filters
                </h3>

                <?php get_template_part('svg/icon-caret-down'); ?>
            </div>
        </div>

        <div class="filters__body closed js-filter-body">
            <div class="filters__selects">
                <div class="filter-detail">
                    <label for="category">Category</label>
                    <select 
                        id="category"
                        name="category" 
                        hx-get="/wp-admin/admin-ajax.php" 
                        hx-trigger="change" 
                        hx-include="[name='document_type'], [name='action_status'], [name='agency'], [name='sub_component'], [name='keyword']"
                        hx-vals='{"action": "filter_actions"}'
                    >
                        <option value="">- Select -</option>
                        <?php
                        $categories = get_categories(array(
                            'hide_empty' => true,
                            'exclude' => 1 // Assuming 'Uncategorized' has ID 1
                        ));
                        
                        foreach($categories as $category) {
                            echo sprintf(
                                '<option value="%s">%s</option>',
                                esc_attr($category->slug),
                                esc_html($category->name)
                            );
                        }
                        ?>
                    </select>
                </div>
                <div class="filter-detail">
                    <label for="agency">Agency</label>
                    <select 
                        id="agency"
                        name="agency" 
                        hx-get="/wp-admin/admin-ajax.php" 
                        hx-trigger="change" 
                        hx-include="[name='document_type'], [name='action_status'], [name='sub_component']"
                        hx-vals='{"action": "filter_actions"}'
                    >
                        <option value="">- Select -</option>
                        <?php
                        $terms = get_terms([
                            'taxonomy' => 'agency',
                            'hide_empty' => true
                        ]);
                        
                        foreach($terms as $term) {
                            echo sprintf(
                                '<option value="%s">%s</option>',
                                esc_attr($term->slug),
                                esc_html($term->name)
                            );
                        }
                        ?>
                    </select>
                </div>

                <div class="filter-detail disabled" id="sub-component-filter">
                    <label for="sub_component">Sub-Component</label>
                    <select 
                        id="sub_component"
                        name="sub_component" 
                        hx-get="/wp-admin/admin-ajax.php" 
                        hx-trigger="change" 
                        hx-include="[name='document_type'], [name='action_status'], [name='agency']"
                        hx-vals='{"action": "filter_actions"}'
                        disabled
                    >
                        <option value="">- Select -</option>
                    </select>
                </div>

                <div class="filter-detail">
                    <label for="document_type">Document Type</label>
                    <select 
                        id="document_type"
                        name="document_type" 
                        hx-get="/wp-admin/admin-ajax.php" 
                        hx-trigger="change" 
                        hx-include="[name='action_status'], [name='agency']"
                        hx-vals='{"action": "filter_actions"}'
                    >
                        <option value="">- Select -</option>
                        <?php
                        $terms = get_terms([
                            'taxonomy' => 'document-type',
                            'hide_empty' => true
                        ]);
                        
                        foreach($terms as $term) {
                            echo sprintf(
                                '<option value="%s">%s</option>',
                                esc_attr($term->slug),
                                esc_html($term->name)
                            );
                        }
                        ?>
                    </select>
                </div>

                <div class="filter-detail">
                    <label for="action_status">Status</label>
                    <select 
                        id="action_status"
                        name="action_status" 
                        hx-get="/wp-admin/admin-ajax.php" 
                        hx-trigger="change" 
                        hx-include="[name='document_type'], [name='agency']"
                        hx-vals='{"action": "filter_actions"}'
                    >
                        <option value="">- Select -</option>
                        <?php
                        $terms = get_terms([
                            'taxonomy' => 'action-status',
                            'hide_empty' => true
                        ]);
                        
                        foreach($terms as $term) {
                            echo sprintf(
                                '<option value="%s">%s</option>',
                                esc_attr($term->slug),
                                esc_html($term->name)
                            );
                        }
                        ?>
                    </select>
                </div>



                <div class="filter-detail search">
                    <label for="keyword-search">Search</label>
                    <input 
                        type="text" 
                        id="keyword-search" 
                        name="keyword" 
                        placeholder="Search..."
                        hx-get="/wp-admin/admin-ajax.php"
                        hx-trigger="keyup changed delay:200ms"
                        hx-include="[name='document_type'], [name='action_status'], [name='agency'], [name='sub_component']"
                        hx-vals='{"action": "filter_actions"}'
                    >
                </div>
            </div>

            <div class="filters__clear-wrapper">
                <button 
                    class="filters__clear"
                    hx-get="/wp-admin/admin-ajax.php"
                    hx-trigger="click"
                    hx-vals='{"action": "filter_actions"}'
                    onclick="document.getElementById('document_type').value = ''; document.getElementById('action_status').value = ''; document.getElementById('agency').value = ''; document.getElementById('keyword-search').value = '';"
                >
                    Clear Filters
                </button>
            </div>


        </div>

    </div>
</section>