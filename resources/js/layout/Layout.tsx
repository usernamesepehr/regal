import Footer from '@/components/templates/footer/Footer'
import Header from '@/components/templates/header/Header'
import React, {  ReactNode } from 'react'

function RootLayout({children}:{children:ReactNode}) {
  return (
    <>
    <Header/>
    {children}
    <Footer/>
    </>
  )
}

export default RootLayout