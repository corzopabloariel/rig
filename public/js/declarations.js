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
            code: {TIPO:"TP_STRING",RULE: "required|max:30",LABEL:1,MAXLENGTH:30,VISIBILIDAD:"TP_VISIBLE",TH:"70px",NOMBRE:"Código", HELP: "Código único", NECESARIO: 1},
            data: {TIPO:"TP_STRING",RULE: "required",NECESARIO:1,LABEL:1,VISIBILIDAD:"TP_VISIBLE", NOMBRE: "Ayuda"}
        },
        FORM: [
            {
                '<div class="col-12">/code/</div>' : ["code"]
            },
            {
                '<div class="col-12">/data/</div>' : ["data"]
            }
        ],
    }
};