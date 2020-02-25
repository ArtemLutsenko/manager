function getJsonData(selector, dataAttr){
    var itemsObj = {},
        itemObj;
    $(selector).each(function(i, el){
        itemObj = $(el).data(dataAttr);
        if (itemsObj.hasOwnProperty(itemObj)){
            itemsObj[itemObj] += parseInt($(this).closest('tr').find('td > span[data-quantity]').text());
        }
        else{
            itemsObj[itemObj] = parseInt($(this).closest('tr').find('td > span[data-quantity]').text());
        }
    })
    var jsonItems = [];

    for(var key in itemsObj){
        var jsonItem = new Object();
        jsonItem.label = key
        jsonItem.value = itemsObj[key]
        jsonItems.push(jsonItem);
    }
    console.log(jsonItems);
    return  jsonItems;
}

var colorPieChart = new d3pie("colorPieChart", {
    "header": {
        "title": {
            "text": "Покраска",
            "fontSize": 24,
            "font": "open sans"
        }
    },
    "footer": {
        "color": "#999999",
        "fontSize": 10,
        "font": "open sans",
        "location": "bottom-left"
    },
    "size": {
        "canvasWidth": 590
    },
    "data": {
        "sortOrder": "value-desc",
        "smallSegmentGrouping": {
            "enabled": true
        },
        "content": getJsonData('span[data-color]', 'color')
    },
    "labels": {
        "outer": {
            "format": "label-value1",
            "pieDistance": 37
        },
        "mainLabel": {
            "font": "verdana"
        },
        "percentage": {
            "color": "#e1e1e1",
            "font": "verdana",
            "decimalPlaces": 0
        },
        "value": {
            "color": "#5d5d5d",
            "font": "verdana"
        },
        "lines": {
            "enabled": true
        }
    },
    "misc": {
        "gradient": {
            "enabled": true,
            "percentage": 100
        }
    }
});

var productPieChart = new d3pie("productPieChart", {
    "header": {
        "title": {
            "text": "Товари",
            "fontSize": 24,
            "font": "open sans"
        }
    },
    "footer": {
        "color": "#999999",
        "fontSize": 10,
        "font": "open sans",
        "location": "bottom-left"
    },
    "size": {
        "canvasWidth": 590
    },
    "data": {
        "sortOrder": "value-desc",
        "smallSegmentGrouping": {
            "enabled": true
        },
        "content": getJsonData('span[data-product-name]', 'productName')
    },
    "labels": {
        "outer": {
            "format": "label-value1",
            "pieDistance": 37
        },
        "mainLabel": {
            "font": "verdana"
        },
        "percentage": {
            "color": "#e1e1e1",
            "font": "verdana",
            "decimalPlaces": 0
        },
        "value": {
            "color": "#5d5d5d",
            "font": "verdana"
        },
        "lines": {
            "enabled": true
        }
    },
    "misc": {
        "gradient": {
            "enabled": true,
            "percentage": 100
        }
    }
});