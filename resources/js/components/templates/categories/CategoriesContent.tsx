import ProductCard from '@/components/modules/products/ProductCard'
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select'
import { SearchNormal } from 'iconsax-react'

function CategoriesContent() {
    return (
        <div className="col-span-9 max-tablet:col-span-12">
            <div className=" flex items-stretch justify-between mb-5 max-tablet:hidden">
                <div className='search-wrapper w-[70%]' >
                    <button className='search-icon' ><SearchNormal className='header-icons stroke-neutral-7' /></button>
                    <input type="text" className='search-input' placeholder='جستجو کنید' />
                </div>
                <div className="w-[28%]" >
                <Select onValueChange={e=>{console.log(e);
                }}>
                    <SelectTrigger className="w-full !h-fit flex-row-reverse search-wrapper">
                        <SelectValue placeholder="مرتب سازی بر اساس" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel className='text-right'>مرتب سازی بر اساس</SelectLabel>
                            <SelectItem className='flex-row-reverse' value="filter0">نام</SelectItem>
                            <SelectItem className='flex-row-reverse' value="filter1">گران ترین</SelectItem>
                            <SelectItem className='flex-row-reverse' value="filter2">ارزان ترین</SelectItem>
                            <SelectItem className='flex-row-reverse' value="filter3">جدیدترین</SelectItem>
                            <SelectItem className='flex-row-reverse' value="filter4">قدیمی ترین</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                </div>
            </div>
            <div className="flex flex-wrap">
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
                <div className="w-4/12 p-2 max-mobile:w-6/12"><ProductCard /></div>
            </div>
        </div>
    )
}

export default CategoriesContent