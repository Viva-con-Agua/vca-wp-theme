<?php $socialAccounts = get_field('socialAccounts', 'options');

    if (isset($socialAccounts) && $socialAccounts !== '') { ?>
        <ul class="socialAccounts">
            <?php foreach ($socialAccounts as $social) {
                $plattform = $social['plattform'];
                $link = $social['link'];
            ?>
                <li class="<?php echo $plattform; ?>">
                    <a target="_blank" href="<?php echo $link; ?>">
                        <?php if ($plattform === 'instagram') { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.96" height="32.775" viewBox="0 0 32.96 32.775">
                                <g transform="translate(-26.908 -196.871)">
                                    <path id="Pfad_375" data-name="Pfad 375" d="M34.839,196.871H52.468c.17.018.34.04.51.055a6.736,6.736,0,0,1,5.88,3.664,19.937,19.937,0,0,1,1.01,3.357v18.784c-.022.137-.049.272-.066.409-.44,3.749-3.091,6.463-6.658,6.485q-9.851.06-19.7-.038a5.953,5.953,0,0,1-4.717-2.274,8.952,8.952,0,0,1-1.78-5.7c-.059-3.846-.03-7.7-.022-11.542,0-2.1-.036-4.2.079-6.3a6.739,6.739,0,0,1,5.173-6.5A26.832,26.832,0,0,1,34.839,196.871Zm-3.688,16.442.216,0c0,1.9-.1,3.8.022,5.686.231,3.575,2.167,5.76,5.7,6.222a53.283,53.283,0,0,0,12.094.067c3.851-.377,5.938-2.4,6.162-6.225a103.356,103.356,0,0,0-.039-11.781,5.956,5.956,0,0,0-5.528-5.842,53.311,53.311,0,0,0-12.861.039,5.921,5.921,0,0,0-5.463,5.673C31.234,209.2,31.245,211.26,31.151,213.313Z" fill="#fff"/>
                                    <path id="Pfad_376" data-name="Pfad 376" d="M43.243,203.421c1.746,0,3.5-.077,5.238.017,2.975.162,4.271,1.419,4.7,4.4a51.12,51.12,0,0,1,.161,8.955,21.719,21.719,0,0,1-.124,2.341c-.354,2.512-1.722,3.895-4.309,4.033-2.939.158-5.889.113-8.835.111a19.274,19.274,0,0,1-2.847-.236c-2.2-.333-3.266-1.3-3.52-3.5a49.553,49.553,0,0,1,.036-12.344c.335-2.483,1.584-3.52,4.1-3.7.9-.063,1.8-.108,2.7-.13s1.8,0,2.7,0Zm-6.081,9.885a6.21,6.21,0,0,0,6.338,6.263,6.228,6.228,0,1,0-6.338-6.263Zm14.15-6.458a1.4,1.4,0,0,0-1.455-1.425,1.427,1.427,0,1,0,.033,2.853A1.409,1.409,0,0,0,51.312,206.848Z" fill="#fff"/>
                                    <path id="Pfad_377" data-name="Pfad 377" d="M47.419,213.361a4.037,4.037,0,1,1-3.888-4.085A3.892,3.892,0,0,1,47.419,213.361Z" fill="#fff"/>
                                </g>
                            </svg>
                        <?php } else if ($plattform === 'facebook') { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32.97" height="32.975" viewBox="0 0 32.97 32.975">
                              <path d="M201.8,181.3v29.8a.26.26,0,0,0-.024.164,1.546,1.546,0,0,1-1.386,1.384c-.191,0-.384.02-.577.02q-3.978,0-7.957,0c-.31,0-.338-.029-.35-.343,0-.1,0-.209,0-.313q0-5.739,0-11.477c0-.776-.05-.741.731-.743,1,0,1.993,0,2.99,0,.5,0,.562-.055.628-.549.168-1.242.325-2.485.483-3.728.05-.394-.037-.5-.436-.5-1.278,0-2.556,0-3.834,0-.543,0-.561-.018-.562-.549,0-1.069-.008-2.138,0-3.207a1.947,1.947,0,0,1,.679-1.539,2.216,2.216,0,0,1,1.434-.485c.788-.014,1.575,0,2.363,0a1.478,1.478,0,0,0,.312-.018.308.308,0,0,0,.255-.257,1.031,1.031,0,0,0,.017-.192c0-1.109,0-2.218,0-3.327,0-.348-.108-.463-.455-.491-1.065-.086-2.131-.161-3.2-.147a7.585,7.585,0,0,0-2.9.541,5.294,5.294,0,0,0-3.085,3.431,7.555,7.555,0,0,0-.352,2.4c.009,1.036,0,2.073,0,3.11,0,.113,0,.225,0,.338-.013.34-.056.391-.4.4-1.013.01-2.026,0-3.039,0-.136,0-.273,0-.41,0-.329.012-.43.112-.441.438-.007.2,0,.4,0,.6v3.11c0,.577.046.623.612.624h2.966c.121,0,.242,0,.362.005.286.017.331.062.348.346.006.1.005.209.005.313q0,5.811,0,11.622c0,.732-.038.587-.586.588q-7.68,0-15.361,0a1.728,1.728,0,0,1-1.357-.51,1.757,1.757,0,0,1-.445-1.3V196.811q0-7.679,0-15.358a1.7,1.7,0,0,1,.6-1.4,1.812,1.812,0,0,1,.973-.343h29.857a.111.111,0,0,0,.089.024,1.459,1.459,0,0,1,1.431,1.407C201.782,181.2,201.764,181.255,201.8,181.3Z" transform="translate(-168.835 -179.712)" fill="#fff"/>
                            </svg>
                        <?php } else if ($plattform === 'twitter') { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="37.843" height="30.841" viewBox="0 0 37.843 30.841">
                              <path d="M13.022,273.421a21.076,21.076,0,0,0,2.475.063,15.363,15.363,0,0,0,8.369-2.868,2.255,2.255,0,0,0,.525-.421,7.922,7.922,0,0,1-7.221-5.435,8.98,8.98,0,0,0,1.756.14,7.594,7.594,0,0,0,1.665-.241,7.939,7.939,0,0,1-6.163-7.757,10.461,10.461,0,0,0,1.72.7,7.575,7.575,0,0,0,1.8.278c-.241-.195-.436-.345-.623-.5a7.806,7.806,0,0,1-1.851-9.676c.1-.193.155-.167.275-.024a21.942,21.942,0,0,0,10.54,7.02,20.787,20.787,0,0,0,5.1.912c.18.009.234-.008.194-.219a7.774,7.774,0,0,1,13.08-7.082.522.522,0,0,0,.556.15,16.082,16.082,0,0,0,4.313-1.657c.072-.04.146-.077.288-.151a7.96,7.96,0,0,1-3.3,4.247,13.541,13.541,0,0,0,2.19-.411,16.52,16.52,0,0,0,2.153-.766,16.1,16.1,0,0,1-1.814,2.245,15.021,15.021,0,0,1-1.862,1.63.416.416,0,0,0-.19.392,22.341,22.341,0,0,1-4.025,13.537,20.791,20.791,0,0,1-11.436,8.419,22.742,22.742,0,0,1-7.8.925,21.776,21.776,0,0,1-10.492-3.279.458.458,0,0,0-.22-.109Z" transform="translate(-13.022 -246.057)" fill="#fff"/>
                            </svg>
                        <?php } ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
