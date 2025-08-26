import ProductCard from '@/components/modules/products/ProductCard'
import { ProductsCardCollectionType } from '@/types/products'
import { usePage } from '@inertiajs/react'
import { Swiper, SwiperSlide } from 'swiper/react'

function HomeOfferSlider() {
    const data=usePage() as {props:{products:ProductsCardCollectionType}}
    const {products}=data.props
  return (
    <Swiper
    slidesPerView={2}
    spaceBetween={24}
    breakpoints={{
        576:{
            slidesPerView:2.5
        },
        768:{
            slidesPerView:3
        },
        992:{
            slidesPerView:4
        }
    }}
    >
        {products.map((product)=>(
        <SwiperSlide key={product.id}>
            <ProductCard product={product}/>
        </SwiperSlide>
        ))}
    </Swiper>
  )
}

export default HomeOfferSlider