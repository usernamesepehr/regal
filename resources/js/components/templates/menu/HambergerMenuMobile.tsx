import { CloseSquare, HambergerMenu } from 'iconsax-react'
import  { useState } from 'react'
import MobileMenuItem from './MobileMenuItem'
import { CtegoriesCollectionType } from '@/types'

function HambergerMenuMobile({categories}:{categories:CtegoriesCollectionType}) {
  const [open,setOpen]=useState<boolean>(false)
  return (
    <>
    <button className='cursor-pointer' onClick={()=>{setOpen(!open)}} >
      {
        open?
        <CloseSquare className='header-icons tablet:hidden'/>:
        <HambergerMenu className='header-icons tablet:hidden'/>
        
      }
      </button>
    <div className={`mobile-menu ${open?'active':''} `}>
    {categories.map(category=>(
      <MobileMenuItem category={category} key={category.id}/>
    ))}
    </div>
    <div className={`bg-overlay tablet:hidden ${open?'active':''}`} onClick={()=>{setOpen(false)}} ></div>
    </>
  )
}

export default HambergerMenuMobile