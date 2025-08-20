export type BlogCardType={
    id: number,
    title: string,
    thumbnail:string,
    description:string,
    slug: string,
    created_at: Date
}
export type BlogCardCollectionType=BlogCardType[]
export type BlogType={
    id: number,
    title:string,
    description:string,
    content:string,
    thumbnail:string,
    slug:string,
    created_at: Date,
    updated_at: null|Date
}