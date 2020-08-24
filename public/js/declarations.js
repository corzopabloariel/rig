/**
 * ----------------------------------------
 *              CONSIDERACIONES
 * ---------------------------------------- */
/**
 * Las entidades nombradas a continuación tienen referencia con una tabla de la BASE DE DATOS.
 * Respetar el nombre de las columnas
 *
 * @version 2
 */
const ENTIDADES = {
    help: {
        TABLE: "helps",
        ROUTE: "helps",
        ATRIBUTOS: {
            code: {TIPO:"TP_STRING",RULE: "required|max:30",LABEL:1,MAXLENGTH:30,VISIBILIDAD:"TP_VISIBLE",TH:"70px",NOMBRE:"Código", HELP: "Código único", NECESARIO: 1, NOTEDIT: 1},
            data: {TIPO:"TP_STRING",RULE: "required",NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE", NOMBRE: "Ayuda"}
        },
        FORM: [
            {
                '<div class="col-12 col-md-4">/code/</div><div class="col-12 col-md">/data/</div>' : ["code", "data"]
            }
        ],
    },
    label: {
        TABLE: "labels",
        ROUTE: "labels",
        ATRIBUTOS: {
            code: {TIPO:"TP_STRING",RULE: "required|max:30",LABEL:1,MAXLENGTH:30,VISIBILIDAD:"TP_VISIBLE",TH:"70px",NOMBRE:"Código", HELP: "Código único", NECESARIO: 1, NOTEDIT: 1},
            data: {TIPO:"TP_STRING",RULE: "required",NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE", NOMBRE: "Etiqueta"}
        },
        FORM: [
            {
                '<div class="col-12 col-md-4">/code/</div><div class="col-12 col-md">/data/</div>' : ["code", "data"]
            }
        ],
    },
    text: {
        TABLE: "texts",
        ROUTE: "texts",
        ATRIBUTOS: {
            code: {TIPO:"TP_STRING",RULE: "required|max:10",LABEL:1,MAXLENGTH:10,VISIBILIDAD:"TP_VISIBLE",TH:"70px",NOMBRE:"Código", HELP: "Código único", NECESARIO: 1, NOTEDIT: 1},
            data: {TIPO:"TP_TEXT",EDITOR:1,VISIBILIDAD:"TP_VISIBLE",FIELDSET:1, NOMBRE:"texto", LABEL: 1}
        },
        FORM: [
            {
                '<div class="col-12 col-md-4">/code/</div>' : ["code"]
            }, {
                '<div class="col-12">/data/</div>' : ["data"]
            }
        ],
        EDITOR: {
            data: {
                toolbarGroups: [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                    { name: 'forms', groups: [ 'forms' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                    { name: 'links', groups: [ 'links' ] },
                    { name: 'insert', groups: [ 'insert' ] },
                    { name: 'styles', groups: [ 'styles' ] },
                    { name: 'colors', groups: [ 'colors' ] },
                    { name: 'tools', groups: [ 'tools' ] },
                    { name: 'others', groups: [ 'others' ] },
                    { name: 'about', groups: [ 'about' ] }
                ],
                colorButton_colors : colorPick,
                removeButtons: 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Redo,Undo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,RemoveFormat,CopyFormatting,NumberedList,BulletedList,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Unlink,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Font,Maximize,ShowBlocks,About'
            }
        },
    },
    operation: {
        TABLE: "operations",
        ROUTE: "operations",
        ATRIBUTOS: {
            code: {TIPO:"TP_STRING",LABEL:1,MAXLENGTH:10,VISIBILIDAD:"TP_VISIBLE_TABLE",TH:"70px",NOMBRE:"Código", NOTEDIT: 1},
            name: {TIPO:"TP_STRING",RULE: "required",NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE", NOMBRE: "Nombre"},
            description: {TIPO:"TP_TEXT",LABEL:1,VISIBILIDAD:"TP_VISIBLE", NOMBRE: "Descripción", NORMAL: 1}
        },
        FORM: [
            {
                '/code/<div class="col-12">/name/</div>' : ["code", "name"]
            }, {
                '<div class="col-12 col-md">/description/</div>' : ["description"]
            }
        ],
    },
};