import { ProductsCardType } from '@/types/products'
import { Link } from '@inertiajs/react'
import React, { useState } from 'react'

function ProductCard({product}:{product?:ProductsCardType}) {
  const [load,setLoad]=useState(false)
  if(product){
    return (
      <Link className='product-card' href={`/products/${product.slug}`} prefetch>
          <img className={`product-card_image ${!load&&'hidden'}`} src={product.image.path} alt={product.name} onLoad={()=>{setLoad(true)}} />
        {!load&&
          <div className="product-card_image_skeleton"></div>
        }
          <p className='product-card_title' >{product.name}</p>
          <p className='product-card_price' >{product.price.toLocaleString()}</p>
      </Link>
    )
  }else{
    return (
      <Link className='product-card' href={'/'}>
          <img className='product-card_image' src="/assets/images/productCard.png" alt="" />
          <p className='product-card_title' >لباس میدی مدرن رایا</p>
          <p className='product-card_price' >3,502,000</p>
      </Link>
    )

  }
}

export default ProductCard