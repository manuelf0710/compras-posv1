export interface Producto {
        id: number,
        categoria_id: number,
        codigo: String,
        descripcion: String,
        imagen: String,
        stock: number,
		precio_compra:number,
		precio_venta:number,
		ventas:number
}