// export type ProductsCardType={
//     id:number,
//     name:string,
//     image:{id:number,path:string}
//     slug:string,
//     price:number,
//     discount:number,
// }
export interface ProductType{
    id:number,
    name:string,
    image:{id:number,path:string}
    slug:string,
    price:number,
    discount:number,
    description:string,
    images:{id:number,path:string}[],

}
export type ProductsCardType=Pick<ProductType,"id","name","discount","image","slug","price">
export type ProductsCardCollectionType=ProductsCardType[]