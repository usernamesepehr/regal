import Breadcrumb from '@/components/modules/breadcrumb/Breadcrumb'
import Container from '@/components/modules/container/Container'
import ProductContentWrapper from '@/components/templates/products/ProductContentWrapper'
import ProductInfoWrapper from '@/components/templates/products/ProductInfoWrapper'
import RelatedProductWrapper from '@/components/templates/products/RelatedProductWrapper'
import { ProductContext } from '@/contexts/product/ProductContext'
import { ProductType } from '@/types/products'

function ProductsPage({product}:{product:ProductType}) {
  return (
    <ProductContext.Provider value={product}>
    <Breadcrumb/>
    <Container>
        <ProductInfoWrapper/>
        <ProductContentWrapper/>
        <RelatedProductWrapper/>
    </Container>
    </ProductContext.Provider>
  )
}

export default ProductsPage