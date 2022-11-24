<?php session_start(); ?>
<div class="sidenav-theme">
    <div class="sidenav-header flex flec-row flex-align-c flex-justify-con-sb">
        <span class="flex flex-col">
            <span class="header_title_heading">Értesítések beállítása</span>
        </span>
        <span class="flex">
            <span class="text-primary" onclick="closeSettingMenu('notifications')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle class="svg" opacity="0.3" cx="12" cy="12" r="10"/><path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" class="svg" /></g>
                </svg>
            </span>
        </span>
    </div>
    <div class="theme-body">
        <div class="theme-desc text-align-c">
            <span class="text-secondary text-small">Módosítsa az oldalon megjelenő értesítéseket, hogy mindig naprakész legyen.</span>
        </div>
        <div class="theme-button-con flex flex-col">
            <div class="theme-item flex flex-row">
                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                    <span class="text-primary">Értesítések</span>
                    <label class="switch">
                        <input type="checkbox" id='theme-auto' checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <span class="sidenav-item flex flex-row" style="background-color: var(--divider);">
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Rendszer értesítések</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right; background-color: var(--items);">
                    </span>
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-col flex-align-c w-100">
                            <span class="sidenav-item-in flex flex-col w-100 border-box padding-1">
                                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                    <span class="text-primary notif-elem">Böngésző</span>
                                    <label class="switch">
                                        <input type="checkbox" id='theme-auto' checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </span>
                            <span class="sidenav-item-in flex flex-col w-100 border-box padding-1">
                                <div class="theme-button flex flex-align-c flex-justify-con-sb">
                                    <span class="text-primary notif-elem">Email</span>
                                    <label class="switch">
                                        <input type="checkbox" id='theme-auto'>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </span>
                        </span>
                    </span>
                </span>
            </span>
            <span class="sidenav-item flex flex-row" style="background-color: var(--divider);">
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Webáruház értesítések</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right; background-color: var(--items);">
                    </span>
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-col flex-align-c w-100">
                            <span class="sidenav-item-in flex flex-col w-100 border-box padding-1">
                                <div class="theme-button flex flex-align-c flex-justify-con-sb w-100">
                                    <span class="text-primary notif-elem">Böngésző</span>
                                    <label class="switch">
                                        <input type="checkbox" id='theme-auto' checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </span>
                            <span class="sidenav-item-in flex flex-col w-100 border-box padding-1">
                                <div class="theme-button flex flex-align-c flex-justify-con-sb">
                                    <span class="text-primary notif-elem">Email</span>
                                    <label class="switch">
                                        <input type="checkbox" id='theme-auto' checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </span>
                        </span>
                    </span>
                </span>
            </span>
            <span class="sidenav-item flex flex-row" style="background-color: var(--divider);">
                <span class="sidenav-item-group flex flex-col">
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-row flex-align-c">
                            <span class="sidenav-item-in flex flex-col">
                                <span class="text-primary sidenav-item-primary-light">Promóciók</span>
                            </span>
                        </span>
                    </span>
                    <span style="text-align: center;">
                        <hr class="sidenav-group-divider" style="text-align: right; background-color: var(--items);">
                    </span>
                    <span class="sidenav-item-group-item">
                        <span class="flex flex-col flex-align-c w-100">
                            <span class="sidenav-item-in flex flex-col w-100 border-box padding-1">
                                <div class="theme-button flex flex-align-c flex-justify-con-sb">
                                    <span class="text-primary notif-elem">Email</span>
                                    <label class="switch">
                                        <input type="checkbox" id='theme-auto' checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </span>
                        </span>
                    </span>
                </span>
            </span>
            <span class="sidenav-item sidenav-item-sb flex flex-row" style="background-color: var(--divider);">
                <span class="sidenav-item-group-item">
                    <span class="flex flex-row flex-align-c">
                        <span class="sidenav-item-in flex">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="2rem" height="2rem" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" class="svg" fill-rule="nonzero"/><path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" class="svg" opacity="0.3"/></g>
                            </svg>
                        </span>
                        <span class="sidenav-item-in flex flex-col">
                            <span class="text-primary sidenav-item-primary-light">Leiratkozás az összesről</span>
                        </span>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>
