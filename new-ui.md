### Example menu item without a tray

```HTML
<li class="ic-app-header__menu-list-item">
              <a id="global_nav_dashboard_link" href="https://stmarksschool.beta.instructure.com/" class="ic-app-header__menu-list-link">
                <div class="menu-item-icon-container" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ic-icon-svg ic-icon-svg--dashboard" version="1.1" x="0" y="0" viewBox="0 0 280 200" enable-background="new 0 0 280 200" xml:space="preserve"><path d="M231.6 94.2c-2.5-4.9-8.5-6.9-13.4-4.5l-57.3 28.6c-5.4-5.2-12.7-8.4-20.8-8.4 -16.6 0-30 13.5-30 30 0 16.6 13.5 30 30 30 16.6 0 30-13.5 30-30 0-1.3-0.1-2.5-0.2-3.8l57.3-28.6C232 105.2 234 99.2 231.6 94.2zM140 150c-5.5 0-10-4.5-10-10s4.5-10 10-10c5.5 0 10 4.5 10 10S145.6 150 140 150zM70 150H50c-5.5 0-10-4.5-10-10s4.5-10 10-10h20c5.5 0 10 4.5 10 10S75.5 150 70 150zM140 80c-5.5 0-10-4.5-10-10V50c0-5.5 4.5-10 10-10 5.5 0 10 4.5 10 10v20C150 75.5 145.5 80 140 80zM105 89.6c-3.5 0-6.8-1.8-8.7-5l-10-17.3c-2.8-4.8-1.1-10.9 3.7-13.7 4.8-2.8 10.9-1.1 13.7 3.7l10 17.3c2.8 4.8 1.1 10.9-3.7 13.7C108.4 89.1 106.7 89.6 105 89.6zM79.4 115.4c-1.7 0-3.4-0.4-5-1.3l-17.3-10c-4.8-2.8-6.4-8.9-3.7-13.7 2.8-4.8 8.9-6.4 13.7-3.7l17.3 10c4.8 2.8 6.4 8.9 3.7 13.7C86.2 113.6 82.8 115.4 79.4 115.4zM173.6 89.6c-1.7 0-3.4-0.4-5-1.3 -4.8-2.8-6.4-8.9-3.7-13.7l10-17.3c2.8-4.8 8.9-6.4 13.7-3.7 4.8 2.8 6.4 8.9 3.7 13.7l-10 17.3C180.4 87.8 177.1 89.6 173.6 89.6zM140 0C62.8 0 0 63 0 140.5V190c0 5.5 4.5 10 10 10h260c5.5 0 10-4.5 10-10v-49.5C280 63 217.2 0 140 0zM260 180H20v-39.5C20 74.1 73.8 20 140 20c66.2 0 120 54.1 120 120.5V180zM230 150h-20c-5.5 0-10-4.5-10-10s4.5-10 10-10h20c5.5 0 10 4.5 10 10S235.5 150 230 150z"></path></svg>
                </div>
                <div class="menu-item__text">Dashboard</div>
              </a>
            </li>
```


### Example menu item with tray

```HTML
<li class="menu-item ic-app-header__menu-list-item">
              <a id="global_nav_courses_link" href="/courses" class="ic-app-header__menu-list-link">
                <div class="menu-item-icon-container" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" class="ic-icon-svg ic-icon-svg--courses" version="1.1" x="0" y="0" viewBox="0 0 280 259" enable-background="new 0 0 280 259" xml:space="preserve"><path d="M226.2 259H32.3c-5.9 0-10.8-4.8-10.8-10.8v-43.5H10.8C4.8 204.8 0 199.9 0 194c0-6 4.8-10.8 10.8-10.8h10.8v-21.6H10.8c-5.9 0-10.8-4.8-10.8-10.8s4.8-10.8 10.8-10.8h10.8v-21.6H10.8c-5.9 0-10.8-4.8-10.8-10.8 0-6 4.8-10.8 10.8-10.8h10.8V75.4H10.8C4.8 75.4 0 70.6 0 64.7s4.8-10.8 10.8-10.8h10.8V10.8c0-6 4.8-10.8 10.8-10.8h193.9c5.9 0 10.8 4.8 10.8 10.8v21.6h32.3c5.9 0 10.8 4.8 10.8 10.8v172.4c0 6-4.8 10.8-10.8 10.8H237v21.9C237 254.2 232.2 259 226.2 259zM43.1 237.4h172.4V21.6H43.1v32.3h10.7c5.9 0 10.8 4.8 10.8 10.8s-4.8 10.8-10.8 10.8H43.1V97h10.7c5.9 0 10.8 4.8 10.8 10.8 0 6-4.8 10.8-10.8 10.8H43.1v21.6h10.7c5.9 0 10.8 4.8 10.8 10.8s-4.8 10.8-10.8 10.8H43.1v21.6h10.7c5.9 0 10.8 4.8 10.8 10.8 0 6-4.8 10.8-10.8 10.8H43.1V237.4zM237 204.8h21.5v-21.6H237V204.8zM237 161.7h21.5v-21.6H237V161.7zM237 118.5h21.5V97H237V118.5zM237 75.4h21.5V53.9H237V75.4zM172.2 129.3H96.9c-5.9 0-10.8-4.8-10.8-10.8V64.7c0-6 4.8-10.8 10.8-10.8h75.3c5.9 0 10.8 4.8 10.8 10.8v53.9C183 124.5 178.2 129.3 172.2 129.3zM107.7 107.8h53.8V75.4h-53.8V107.8z"></path></svg>
                </div>
                <div class="menu-item__text">
                  Courses
                </div>
              </a>
            </li>
```

The `.ReactTrayPortal` object when no tray is present:

```HTML
<div class="ReactTrayPortal"><div data-reactid=".2" class="ReactTray__Overlay " style="position: fixed; top: 0px; left: 0px; right: 0px; bottom: 0px;"><div style="position:absolute;background:#fff;" class="ReactTray__Content " tabindex="-1" data-reactid=".2.0"></div></div></div>
```

The `.ReactTrayPortal` object when the menu-item is clicked:

```HTML
<div class="ReactTrayPortal"><div data-reactid=".2" class="ReactTray__Overlay ReactTray__Overlay--after-open " style="position: fixed; top: 0px; left: 0px; right: 0px; bottom: 0px;"><div style="position:absolute;background:#fff;" class="ReactTray__Content ReactTray__Content--after-open " tabindex="-1" data-reactid=".2.0"><div class="ReactTray__layout" data-reactid=".2.0.0"><div class="ReactTray__primary-content" data-reactid=".2.0.0.0"><div class="ReactTray__header" data-reactid=".2.0.0.0.0"><h1 class="ReactTray__headline" data-reactid=".2.0.0.0.0.0">Courses</h1><button class="Button Button--icon-action ReactTray__closeBtn" type="button" data-reactid=".2.0.0.0.0.1"><i class="icon-x" data-reactid=".2.0.0.0.0.1.0"></i><span class="screenreader-only" data-reactid=".2.0.0.0.0.1.1">Close</span></button></div><ul class="ReactTray__link-list" data-reactid=".2.0.0.0.1"><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$2714"><a href="/courses/2714" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$2714.0">Adv. Topics in Comp. Sci. (Red)</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$2714.1">2015-2016 Full Year</div></li><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$2610"><a href="/courses/2610" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$2610.0">Algebra II (Blue)</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$2610.1">2015-2016 Full Year</div></li><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$3174"><a href="/courses/3174" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$3174.0">Battis Advisory Group</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$3174.1">2015-2016 Full Year</div></li><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$2966"><a href="/courses/2966" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$2966.0">FIRST Robotics: Team 3566</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$2966.1">2015-2016 Full Year</div></li><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$3506"><a href="/courses/3506" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$3506.0">Language Lab Test</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$3506.1">Default Term</div></li><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$3504"><a href="/courses/3504" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$3504.0">Language Lab Test (AB)</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$3504.1">Default Term</div></li><li class="ReactTray-list-item" data-reactid=".2.0.0.0.1.$3502"><a href="/courses/3502" class="ReactTray-list-item__link" data-reactid=".2.0.0.0.1.$3502.0">Language Lab Test (MK)</a><div class="ReactTray-list-item__helper-text" data-reactid=".2.0.0.0.1.$3502.1">Default Term</div></li><li class="ReactTray-list-item ReactTray-list-item--feature-item" data-reactid=".2.0.0.0.1.$allCourseLink"><a href="/courses" data-reactid=".2.0.0.0.1.$allCourseLink.0">All Courses</a></li></ul></div><div class="ReactTray__secondary-content" data-reactid=".2.0.0.1"><div class="ReactTray__info-box" data-reactid=".2.0.0.1.0">Welcome to your courses! To customize the list of courses, click on the "All Courses" link and star the courses to display.</div></div></div></div></div></div>
```