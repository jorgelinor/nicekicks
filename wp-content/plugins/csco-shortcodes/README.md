CSCO: Shortcodes
===

WordPress plugin that provides shortcodes for themes by Code Supply Co.

## Shortcode Reference

* [Grid](#grid)
* [Alerts](#alerts)
* [Tabs](#tabs)
* [Collapse](#collapse)

# Usage

### Grid
    [row]
      [column md="6"]
        ...
      [/column]
      [column md="6"]
        ...
      [/column]
    [/row]
    
#### [row] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [column] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xs | Size of column on extra small screens (less than 768px) | optional | 1-12 | false
sm | Size of column on small screens (greater than 768px) | optional | 1-12 | false
md | Size of column on medium screens (greater than 992px) | optional | 1-12 | false
lg | Size of column on large screens (greater than 1200px) | optional | 1-12 | false
offset_xs | Offset on extra small screens | optional | 1-12 | false
offset_sm | Offset on small screens | optional | 1-12 | false
offset_md | Offset on column on medium screens | optional | 1-12 | false
offset_lg | Offset on column on large screens | optional | 1-12 | false
pull_xs | Pull on extra small screens | optional | 1-12 | false
pull_sm | Pull on small screens | optional | 1-12 | false
pull_md | Pull on column on medium screens | optional | 1-12 | false
pull_lg | Pull on column on large screens | optional | 1-12 | false
push_xs | Push on extra small screens | optional | 1-12 | false
push_sm | Push on small screens | optional | 1-12 | false
push_md | Push on column on medium screens | optional | 1-12 | false
push_lg | Push on column on large screens | optional | 1-12 | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

* * *

### Alerts
  [alert type="success"] ... [/alert]

#### [alert] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of the alert | required | success, info, warning, danger | success
dismissable | If the alert should be dismissable | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. | optional | any text | none

* * *

### Tabs
  [tabs type="tabs"]
    [tab title="Home" active="true"]
      ...
    [/tab]
    [tab title="Profile"]
      ...
    [/tab]
    [tab title="Messages"]
      ...
    [/tab]
  [/tabs]

#### [tabs] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
type | The type of nav | required | tabs, pills | tabs
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [tab] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The title of the tab | required | any text | false
active | Whether this tab should be "active" or selected | optional | true, false | false
fade | Whether to use the "fade" effect when showing this tab | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

* * * 

### Collapse

#### Single Collapse
    [collapse title="Collapse 1" active="true"]
      ...
    [/collapse]
      
#### Set of Collapsibles
  [collapsibles]
    [collapse title="Collapse 1" active="true"]
      ...
    [/collapse]
    [collapse title="Collapse 2"]
      ...
    [/collapse]
    [collapse title="Collapse 3"]
      ...
    [/collapse]
  [/collapsibles]

#### [collapsibles] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none

#### [collapse] parameters
Parameter | Description | Required | Values | Default
--- | --- | --- | --- | ---
title | The title of the collapsible, visible when collapsed | required | any text | false
type | The type of the panel | optional | default, primary, success, info, warning, danger, link | default
active | Whether the tab is expanded at load time | optional | true, false | false
xclass | Any extra classes you want to add | optional | any text | none
data | Data attribute and value pairs separated by a comma. Pairs separated by pipe (see example at [Button Dropdowns](#button-dropdowns)). | optional | any text | none
