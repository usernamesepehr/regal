'use client'
import React, { useState } from 'react'
import ProductTab from './ProductTab'
import { useProductContext } from '@/contexts/product/ProductContext'
import { ProductType } from '@/types/products'

function ProductContentWrapper() {
    const [tab,setTab]=useState('')
    const product=useProductContext() as ProductType
  return (
    <div className="col-span-12 max-tablet:hidden">
        <div className="product-tab-wrapper">
            <ProductTab {...{text:'توضیحات محصول',tab,setTab}} />
            <ProductTab {...{text:'ویژگی های محصول',tab,setTab}} />
            <ProductTab {...{text:'نحوه نگهداری',tab,setTab}} />
            <ProductTab {...{text:'راهنمای سایز',tab,setTab}} />
            <ProductTab {...{text:'نظرات مشتریان',tab,setTab}} />
            <ProductTab {...{text:'سوالات متداول',tab,setTab}} />
            <ProductTab {...{text:'اکسسوری ها',tab,setTab}} />
        </div>
        <div className="py-5 border-b border-b-neutral-4" dangerouslySetInnerHTML={{__html:product.description}}></div>
        
    </div>
  )
}

export default ProductContentWrapper