import AccountSideBar from '@/components/modules/accountSideBar/AccountSideBar'
import React, { ReactNode } from 'react'

function AccountLayout({children}:{children:ReactNode}){
    const url=undefined
  return (
    <div className="my-8">
        <div className="container">
            <div className="col-span-3 max-laptop:hidden"><AccountSideBar {...{url}}/></div>
            <div className="col-span-9 max-laptop:col-span-12">{children}</div>
        </div>
        </div>
  )
}

export default AccountLayout