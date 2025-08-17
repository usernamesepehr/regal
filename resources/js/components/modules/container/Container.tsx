import React from 'react';

function Container({ children, className }: { children: React.ReactNode; className?: string }): React.ReactElement {
  return (
    <div className={`container ${className || ''}`.trim()}>{children}</div>
  );
}

export default Container;
