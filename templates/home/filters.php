<section class="filters | content-grid">
    <div class="filters__wrapper" 
        hx-target="#actions-list" 
        hx-swap="outerHTML"
    >
        <div class="filters__selects">
            <div class="filter-detail">
                <label for="document_type">Type</label>
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

            <div class="filter-detail">
                <label for="agency">Agency</label>
                <select 
                    id="agency"
                    name="agency" 
                    hx-get="/wp-admin/admin-ajax.php" 
                    hx-trigger="change" 
                    hx-include="[name='document_type'], [name='action_status']"
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
        </div>

        <button 
            class="filters__clear"
            hx-get="/wp-admin/admin-ajax.php"
            hx-trigger="click"
            hx-vals='{"action": "filter_actions"}'
            onclick="document.getElementById('document_type').value = ''; document.getElementById('action_status').value = ''; document.getElementById('agency').value = '';"
        >
            Clear Filters
        </button>
    </div>
</section>