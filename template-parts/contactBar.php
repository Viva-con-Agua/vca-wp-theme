<?php $contactBar = get_field('contactBar', 'options');

if (isset($contactBar) && is_array($contactBar) && count($contactBar) > 0) { ?>
    <ul id="contactBar">
        <?php foreach ($contactBar as $contact) {
            $contactIcon = $contact['contactIcon'];
            $contactLink = $contact['contactLink'];
            ?>
            <li>
                <a href="<?php echo $contactLink['url']; ?>">
                    <div class="contactLink">
                        <?php
                            echo getPicture($contactIcon['ID'], 'tiny', 'lazy', array('tiny'));
                            echo '<span>'. $contactLink['title'] .'</span>';
                        ?>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
