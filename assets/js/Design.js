var customImageParams = jQuery.extend(
    {
        "left": 0,
        "y": 0,
        "z": -1,
        "minScaleLimit": "0.0100",
        "price": 0,
        "replaceInAllViews": false,
        "autoCenter": true,
        "draggable": true,
        "rotatable": true,
        "resizable": true,
        "zChangeable": false,
        "autoSelect": true,
        "topped": false,
        "uniScalingUnlockable": false,
        "boundingBoxMode": "clipping",
        "removable": true,
        "boundingBox": "upload"
    },
    {
        "minW": 1,
        "minH": 1,
        "maxW": 200000,
        "maxH": 200000,
        "resizeToW": 0,
        "resizeToH": 0,
        "maxSize": 1000,
        "minDPI": 1,
        "minScaleLimit": "0.0100",
        "advancedEditing": false,
        "filter": "none"
    });

var customTextParameters = {
    "left": 0,
    "y": 0,
    "z": -1,
    "fill": "#ffffff",
    "colors": "#000000",
    "price": 0,
    "replaceInAllViews": false,
    "autoCenter": true,
    "draggable": true,
    "rotatable": true,
    "resizable": true,
    "zChangeable": false,
    "autoSelect": true,
    "topped": false,
    "curvable": false,
    "curveSpacing": 10,
    "curveRadius": 80,
    "curveReverse": false,
    "boundingBoxMode": "clipping",
    "fontSize": 30,
    "minFontSize": 1,
    "maxFontSize": 1000,
    "maxLength": 0,
    "maxLines": 0,
    "textAlign": "left",
    "removable": true,
    "boundingBox": "upload"
};

var uiLayoutOptions = {
    "gridColumns": "2",
    "initialActiveModule": "",
    "selectedColor": "#0070c9",
    "boundingBoxColor": "#ffffff",
    "outOfBoundaryColor": "#9e0000",
    "cornerIconColor": "#ffffff",
    "mainBarModules": ["images", "text", "designs"],
    "mainBar": ["images", "text", "designs",],
    "actions": {
        "top": [],
        "right": [],
        "bottom": [],
        "left": ["undo", "redo", "reset-product"]
    },
    "toolbarPlacement": "smart",
    "toolbarTheme": "dark"
};
var customImageAjaxSettings = {
    url: '/products/upload',
    method: 'POST',
    data: {
        saveOnServer: 0,
        uploadsDir: '/media/product',
        uploadsDirURL: 'http://phone.local/media/product'
    }
}
var pluginOpts = {
    designsJSON: '',
    langJSON: fpd_base_url+'/lang/default.json',
    editorMode: false,
    smartGuides: true,
    fonts: [
        {
            name: "Times New Roman"
        },
        {
            name: "Pacifico",
            url: fpd_base_url+"/fonts/Pacifico-Regular.ttf"
        },
        {
            name: "Arial"
        },
        {
            name: "Amatic regular",
            url: "assets/fonts/AmaticSC-Regular.ttf"
        },
        {
            name: "Amatic bold",
            url: fpd_base_url+"/fonts/AmaticSC-Bold.ttf"
        },
        {
            name: "Arima madurai",
            url: fpd_base_url+"/fonts/ArimaMadurai-Light.ttf"
        },
        {
            name: "Charm",
            url: fpd_base_url+"/fonts/Charm-Regular.ttf"
        },
        {
            name: "Charmonman",
            url: fpd_base_url+"/fonts/Charmonman-Regular.ttf"
        },
        {
            name: "Comfortaa",
            url: fpd_base_url+"/fonts/Comfortaa-Light.ttf"
        },
        {
            name: "Dancing",
            url: fpd_base_url+"/fonts/DancingScript-Regular.ttf"
        },
        {
            name: "Farsan",
            url: fpd_base_url+"/fonts/Farsan-Regular.ttf"
        },
        {
            name: "Itim",
            url: fpd_base_url+"/fonts/Itim-Regular.ttf"
        },
        {
            name: "Jura",
            url: fpd_base_url+"/fonts/Jura-Regular.ttf"
        },
        {
            name: "Open Sans Condensed",
            url: fpd_base_url+"//fonts/OpenSansCondensed-LightItalic.ttf"
        },
        {
            name: "Oswald",
            url: fpd_base_url+"/fonts/Oswald-Regular.ttf"
        },
        {
            name: "Patrick Hand",
            url: fpd_base_url+"/fonts/PatrickHand-Regular.ttf"
        },
        {
            name: "Pattaya",
            url: fpd_base_url+"/fonts/Pattaya-Regular.ttf"
        },
        {
            name: "Play",
            url: fpd_base_url+"/fonts/Play-Regular.ttf"
        },
        {
            name: "Roboto Condensed",
            url: fpd_base_url+"/fonts/RobotoCondensed-Regular.ttf"
        },
        {
            name: "Sedgwick Ave",
            url: fpd_base_url+"/fonts/SedgwickAve-Regular.ttf"
        }
    ],
    elementParameters: {
        boundingBoxMode: 'clipping',
        boundingBox: false,
        autoCenter: true,
        colorLinkgroup: true,
        originX: 'center',
        originY: 'center'
    },
    boundingBoxProps: {
        strokeWidth: 1
    },
    imageParameters: {
        padding: 0,
        colorPrices: {},
        replaceInAllViews: 0,
        patterns: []
    },
    textParameters: {
        padding: 10,
        fontFamily: "Arial",
        colorPrices: {},
        replaceInAllViews: 0,
        patterns: []
    },
    facebookAppId: "",
    instagramClientId: "",
    zoomStep: 0.2,
    maxZoom: 3,
    hexNames: {},
    replaceInitialElements: 1,
    lazyLoad: 1,
    improvedResizeQuality: 0,
    uploadZonesTopped: 1,
    responsive: 1,
    priceFormat: {
        currency: "%d&#8363;",
    },
    templatesType: ['html'],
    watermark: "",
    loadFirstProductInStage: 1,
    unsavedProductAlert: 1,
    hideDialogOnAdd: 1,
    snapGridSize: [50, 50],
    fitImagesInCanvas: 1,
    inCanvasTextEditing: 1,
    openTextInputOnSelect: 0,
    saveActionBrowserStorage: 0,
    uploadAgreementModal: 0,
    autoOpenInfo: 0,
    allowedImageTypes: ["jpeg", "png", "svg"],
    replaceColorsInColorGroup: 0,
    pixabayApiKey: "",
    pixabayHighResImages: true,
    openModalInDesigner: 0,
    imageSizeTooltip: 0,
    applyFillWhenReplacing: 0,
    highlightEditableObjects: "",
    depositphotosApiKey: "",
    depositphotosPrice: 0,
    depositphotosLang: "en",
    mainBarContainer: false,
    layouts: ['Slide Bar Left']
};