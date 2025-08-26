import { ProductType } from '@/types/products';
import { createContext, ReactNode, useContext } from 'react';
export const ProductContext = createContext<ProductType | null>(null);
interface ProductProviderProps {
  children: ReactNode;
  data: ProductType;
}

export default function ProductProvider({ children, data }: ProductProviderProps) {
  return <ProductContext.Provider value={data}>{children}</ProductContext.Provider>;
}
export function useProductContext(){
    return useContext(ProductContext)
}